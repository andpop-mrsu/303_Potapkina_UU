insert into users(first_name, last_name, email, register_date, gender, occupation_id)
values
('Julia', 'Potapkina', 'Potapkina_Julia@gmail.com', date('now'), 'female', (select id from occupations as o where o.title = 'student'));
insert into users(first_name, last_name, email, register_date, gender, occupation_id)
values
('Dmitry', 'Parshin', 'Parshin_Dmitry@gmail.com', date('now'), 'male', (select id from occupations as o where o.title = 'student'));
insert into users(first_name, last_name, email, register_date, gender, occupation_id)
values
('Daniil', 'Osipov', 'Osipov_Daniil@gmail.com', date('now'), 'male', (select id from occupations as o where o.title = 'student'));
insert into users(first_name, last_name, email, register_date, gender, occupation_id)
values
('Daria', 'Rodkina', 'Rodkina_Daria@gmail.com', date('now'), 'female', (select id from occupations as o where o.title = 'student'));
insert into users(first_name, last_name, email, register_date, gender, occupation_id)
values
('Alina', 'Ruzaeva', 'Ruzaeva_Alina@gmail.com', date('now'), 'female', (select id from occupations as o where o.title = 'student'));

insert into movies(title, year) 
values('Film_1_2021', 2021),
('Film_2_2021', 2021),
('Film_3_2021', 2021);

insert into ratings(user_id, movie_id, rating, 'timestamp')
values
((select id from users where users.email = 'Potapkina_Julia@gmail.com'), 
(select id from movies where movies.title = 'Film_1_2021' and movies.year = 2021),
2.75,
strftime('%s','now'));

insert into ratings(user_id, movie_id, rating, 'timestamp')
values
((select id from users where users.email = 'Potapkina_Julia@gmail.com'), 
(select id from movies where movies.title = 'Film_2_2021' and movies.year = 2021),
3.25,
strftime('%s','now'));

insert into ratings(user_id, movie_id, rating, 'timestamp')
values
((select id from users where users.email = 'Potapkina_Julia@gmail.com'), 
(select id from movies where movies.title = 'Film_3_2021' and movies.year = 2021),
3.75,
strftime('%s','now')); 