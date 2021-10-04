import csv
import re





def get_movies():
    f = open("movies.csv", 'r')
    _movies = []
    for ind, line in enumerate(f.readlines()):
        if ind == 0 or line == '': continue
        line = line.replace('\n', '')
        id = re.findall('\d+', line)[0]
        it = line.find(',')
        line = line[it + 1 : -1]
        it = line.rfind(',')
        genres = line[it+1:-1]
        line = line[0:it]

        try: year = re.findall('\(\d+\)', line)[0]
        except: year = '0000'
        line = line.replace(year, '')
        year = year[1:-1]
        line = line.strip(' ')
        title = line
        title = title.replace("'", '"')
        _movies.append([id, title, year, genres])

    return _movies


def get_ratings():
    f = open('ratings.csv', 'r')
    _ratings = []
    for ind, line in enumerate(f.readlines()):
        if ind == 0 or line == '': continue
        line = line.replace('\n', '')
        id = ind
        vals = line.split(',')
        user_id = vals[0]
        movie_id = vals[1]
        rating = vals[2]
        timestamp = vals[3]
        _ratings.append([id, user_id, movie_id, rating, timestamp])
    return _ratings


def get_tags():
    f = open('tags.csv', 'r')
    _tags = []
    for ind, line in enumerate(f.readlines()):
        if ind == 0 or line == '': continue
        line = line.replace('\n', '')
        id = ind
        vals = line.split(',')
        user_id = vals[0]
        movie_id = vals[1]
        tag = vals[2]
        timestamp = vals[3]
        _tags.append([id, user_id, movie_id, tag, timestamp])
    return _tags


def get_users():
    f = open('users.txt', 'r')
    _users = []
    for line in f.readlines():
        line = line.replace('\n', '')
        _users.append(line.split('|'))
    return _users


if __name__ == '__main__':



    db = open('db_init.sql', 'w')
    #db.write('.open movie_ratings.db;\n')

    table_names = ['movies', 'ratings', 'tags', 'users']
    for tab_name in table_names:
        db.write('DROP TABLE IF EXISTS ' + tab_name + ';\n')




    db.write(
        """CREATE TABLE movies(
            id integer primary key,
            title text,
            year integer,
            genres text
            );
            CREATE TABLE ratings(
            id integer primary key,
            user_id integer,
            movie_id integer,
            ratings float,
            timestamp integer
            );
            CREATE TABLE tags(
            id int primary key,
            user_id integer,
            movie_id integer,
            tag text,
            timestamp integer
            );
            CREATE TABLE users(
            id int primary key,
            name text,
            email text,
            gender text,
            register_date text,
            occupation text
            );\n"""
    )

    movies = get_movies()
    db.write('INSERT INTO movies VALUES\n')
    for ind, movie in enumerate(movies):
        db.write(str(tuple(movie)))
        if ind!=len(movies)-1: db.write(',\n')
    db.write(';\n')

    ratings = get_ratings()
    db.write('INSERT INTO ratings VALUES\n')
    for ind, rating in enumerate(ratings):
        db.write(str(tuple(rating)))
        if ind != len(ratings) - 1: db.write(',\n')
    db.write(';\n')

    tags = get_tags()
    db.write('INSERT INTO tags VALUES\n')
    for ind, tag in enumerate(tags):
        db.write(str(tuple(tag)))
        if ind != len(tags) - 1: db.write(',\n')
    db.write(';\n')

    users = get_users()
    db.write('INSERT INTO users VALUES\n')
    for ind, user in enumerate(users):
        db.write(str(tuple(user)))
        if ind != len(users) - 1: db.write(',\n')
    db.write(';\n')

















