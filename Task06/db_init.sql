drop table if exists workers_busyness;
drop table if exists specialization;
drop table if exists busyness;
drop table if exists sign_up_workers_services_car_categories;
drop table if exists sign_up;
drop table if exists workers;
drop table if exists services_car_categories;
drop table if exists services;
drop table if exists car_categories;

create table if not exists workers(
    id integer primary key autoincrement not null, 
    last_name text, 
    first_name text,
    patronymic text,
    date_of_birth text,
    specialization_id integer not null,
    number_of_directed_works integer,
    number_of_completed_works integer,
    percentage_of_revenue real,
    status text,
    foreign key (specialization_id) references specialization (id) on delete restrict on update cascade
    check (number_of_directed_works>=0 and number_of_completed_works>=0 and percentage_of_revenue>0 and (status = 'является работником' or status = 'не является работником'))
);
create table if not exists specialization(
    id integer primary key autoincrement not null,
    title text
);

create table if not exists busyness(
    id integer primary key autoincrement not null,
    data text,
    work_hours text,
    free_hours text
);
create table if not exists workers_busyness(
    id integer primary key autoincrement not null,
    worker_id integer not null,
    busyness_id integer not null,
    foreign key (worker_id) references workers (id) on delete restrict on update cascade,
    foreign key (busyness_id) references busyness (id) on delete restrict on update cascade
);
create table if not exists services(
    id integer primary key autoincrement not null,
    name_of_service text
);
create table if not exists car_categories(
    id integer primary key autoincrement not null,
    marking text, 
    description text
);
create table if not exists services_car_categories(
    id integer primary key autoincrement not null,
    duration_in_hours real,
    price real,
    service_id integer not null,
    car_category_id integer not null,
    foreign key (service_id) references services (id) on delete restrict on update cascade,
    foreign key (car_category_id) references car_categories (id) on delete restrict on update cascade,
    check (duration_in_hours>0 and price>0)
);
create table if not exists sign_up(
    id integer primary key autoincrement not null,
    time_of_record text,
    service_execution_time text,
    contact_phone_number text default null,
    completion_of_work text,
    car_brand text default null,
    car_model text default null,
    check(contact_phone_number like '+%' and (completion_of_work = 'да' or completion_of_work = 'нет'))
);
create table if not exists sign_up_workers_services_car_categories(
    id integer primary key autoincrement not null,
    sign_up_id integer not null,
    worker_id integer not null,
    services_car_categories_id integer not null,
    foreign key (sign_up_id) references sign_up (id) on delete restrict on update cascade,
    foreign key (worker_id) references workers (id) on delete restrict on update cascade,
    foreign key (services_car_categories_id) references services_car_categories (id) on delete restrict on update cascade
);

insert into specialization(title)
values
('Автомеханик'),
('Автоэлектрик'),
('Мастер кузовного ремонта'),
('Автомаляр');

insert into workers (last_name, first_name, patronymic, date_of_birth, specialization_id, number_of_directed_works, number_of_completed_works, percentage_of_revenue, status)
values
('Иванов', 'Александр', 'Александрович', '1985-04-15', (select id from specialization as s where s.title = 'Автомеханик'), 2, 2, 30, 'является работником'),
('Смирнов', 'Михаил', 'Михайлович', '1990-07-22', (select id from specialization as s where s.title = 'Автомеханик'), 2, 2, 27, 'является работником'),
('Кузнецов', 'Иван', 'Иванович', '1992-01-12', (select id from specialization as s where s.title = 'Автомеханик'), 1, 1, 26, 'является работником'),
('Васильев', 'Максим', 'Максимович', '1990-06-01', (select id from specialization as s where s.title = 'Автомеханик'), 1, 1, 27, 'является работником'),
('Петров', 'Артём', 'Артёмович', '1987-10-10', (select id from specialization as s where s.title = 'Автоэлектрик'), 1, 1, 29, 'является работником'),
('Соколов', 'Даниил', 'Даниилович', '1983-12-05', (select id from specialization as s where s.title = 'Автоэлектрик'), 0, 0, 27, 'является работником'),
('Михайлов', 'Дмитрий', 'Дмитриевич', '1993-04-30', (select id from specialization as s where s.title = 'Мастер кузовного ремонта'), 1, 1, 32, 'является работником'),
('Новиков', 'Кирилл', 'Кириллович', '1995-10-12', (select id from specialization as s where s.title = 'Мастер кузовного ремонта'), 0, 0, 25, 'является работником'),
('Федоров', 'Андрей', 'Андреевич', '1990-05-02', (select id from specialization as s where s.title = 'Мастер кузовного ремонта'), 0, 0, 28, 'является работником'),
('Морозов', 'Егор', 'Егорович', '1992-07-07', (select id from specialization as s where s.title = 'Автомаляр'), 1, 1, 31, 'является работником');

insert into busyness (data, work_hours, free_hours)
values
('2021-04-01', '9:00-17:00', '9:00-14:00'),
('2021-04-01', '10:00-18:00', '11:00-16:30'),
('2021-04-01', '9:00-17:00', '10:00-17:00'),
('2021-04-01', '10:00-18:00', '10:00-16:30'),
('2021-04-01', '8:00-16:00', '8:00-16:00'),
('2021-04-01', '10:00-18:00', '10:30-18:00'),
('2021-04-02', '9:00-17:00', '9:00-17:00'),
('2021-04-02', '10:00-18:00', '12:00-18:00'),
('2021-04-02', '10:00-18:00', '11:00-18:00'),
('2021-04-02', '11:00-19:00', '12:00-17:30'),
('2021-04-02', '12:00-20:00', '12:00-20:00'),
('2021-04-02', '12:00-20:00', '14:30-19:00');

insert into workers_busyness (worker_id, busyness_id)
values
(1, 2),
(2, 1),
(3, 4),
(4, 3),
(5, 6),
(6, 5),
(7, 9),
(8, 7),
(9, 11),
(10, 8),
(11, 12),
(12, 10);

insert into services (name_of_service)
values
('замена масла в двс'),
('замена масляного фильтра'),
('замена топливного фильтра'),
('замена тормозной жидкости'),
('промывка инжектора'),
('замена свечей зажигания'),
('замена масла'),
('капитальный ремонт двигателя'),
('замена ремня и цепи грм'),
('замена радиатора'),
('замена турбины'),
('покраска кузова автомобиля (полная окраска одного элемента)'),
('покраска кузова автомобиля (локальная окраска одного элемента)'),
('ремонт бампера'),
('вакуумное удаление вмятин без покраски'),
('восстановление геометрии кузова'),
('замена сцепления'),
('замена амортизатора'),
('компьютерная диагностика развал-схождение 3d'),
('балансировка колёс'),
('замена акпп'),
('ремонт мкпп'),
('установка парктроников'),
('установка камер заднего вида'),
('шумоизоляция автомобиля'),
('автомойка'),
('полировка'),
('химчистка');

insert into car_categories (marking,description)
values
('l1', 'двухколёсные мопеды/мотовелосипеды'),
('l2', 'трёхколёсные мопеды/мотовелосипеды'),
('l3', 'двухколёсные мотоциклы/мотороллеры'),
('l4', 'трициклы с ассиметричными относительно средней продольной плоскости колёсами'),
('l5', 'трициклы с симметричными относительно средней продольной плоскости колёсами'),
('l6', 'квадрициклы с ненагруженной массой меньше 350 кг'),
('l7', 'квадрициклы с ненагруженной массой меньше 400 кг'),
('m1', 'легковые автомобили'),
('m2', 'автобусы и троллейбусы с технически допустимой макс.массой не более 5 тонн'),
('m3', 'автобусы и троллейбусы с технически допустимой макс.массой более 5 тонн'),
('n1', 'грузовые автомобили с грузоподъёмностью не более 3.5 тонн'),
('n2', 'грузовые автомобили с грузоподъёмностью более 3.5 тонн и не более 12 тонн'),
('n3', 'грузовые автомобили с грузоподъёмностью более 12 тонн'),
('o1', 'прицепы с грузоподъёмностью не более 0.75 тонн'),
('o2', 'прицепы с грузоподъёмностью более 0.75 тонн и не более 3.5 тонн'),
('o3', 'прицепы с грузоподъёмностью более 3.5 тонн и не более 10 тонн'),
('o4', 'прицепы с грузоподъёмностью более 10 тонн');

insert into services_car_categories (duration_in_hours, price, service_id, car_category_id)
values
(1, 220, 1, 8),
(1.5, 320, 1, 9),
(1.5, 300, 1, 11),
(2, 400, 1, 12),
(0.5, 150, 1, 3),
(1, 220, 2, 8),
(1.5, 300, 2, 11),
(1, 500, 3, 8),
(1.5, 650, 3, 11),
(1.5, 1000, 4, 8),
(2, 1200, 4, 11),
(2, 1500, 5, 8),
(0.5, 300, 6, 8),
(1, 400, 6, 11),
(0.5, 220, 7, 3),
(0.5, 220, 7, 8),
(1, 300, 7, 9),
(1, 320, 7, 10),
(1, 320, 7, 11),
(1, 350, 7, 12),
(6, 10000, 8, 8),
(7, 13000, 8, 11),
(2, 2000, 9, 8),
(1, 800, 10, 8),
(5, 5000, 11, 8),
(6, 6500, 11, 11),
(1, 2000, 12, 3),
(2, 5000, 12, 8),
(0.5, 1000, 13, 3),
(1, 2500, 13, 8),
(2, 1000, 14, 8),
(3, 2000, 14, 11),
(1.5, 3000, 15, 8),
(2.5, 4000, 15, 11),
(4, 4000, 16, 8),
(5, 6000, 16, 11),
(1, 1000, 17, 8),
(1.5, 1500, 17, 11),
(1, 800, 18, 8),
(1.5, 1300, 18, 11),
(0.5, 1000, 19, 8),
(1, 1500, 19, 11),
(2, 2000, 20, 8),
(2.5, 2500, 20, 11),
(3, 3000, 20, 12),
(3, 4000, 21, 8),
(4, 6000, 21, 11),
(4.5, 6500, 21, 12),
(4, 5000, 22, 8),
(5, 7000, 22, 11),
(0.5, 400, 23, 8),
(0.5, 500, 24, 8),
(1, 1000, 25, 8),
(1, 1100, 26, 8),
(1, 1500, 26, 11),
(2.5, 4000, 27, 8),
(1.5, 1000, 28, 8);

insert into sign_up (time_of_record, service_execution_time, contact_phone_number, completion_of_work, car_brand, car_model)
values
('2021-03-30 14:37', '2021-04-01 14:00-15:00', '+79176959495', 'да', 'lada', 'largus'),
('2021-03-30 15:01', '2021-04-01 15:00-17:00', '+79270749656', 'да', 'renault', 'sandero'),
('2021-03-30 15:15', '2021-04-01 10:00-11:00', '+79033254242', 'да', 'lada', 'granta'),
('2021-03-30 15:22', '2021-04-01 16:30-18:00', '+79052558762', 'да', 'lada', 'vesta'),
('2021-03-30 15:31', '2021-04-01 9:00-10:00', '+79274856124', 'да', 'hyundai', 'solaris'),
('2021-03-30 15:35', '2021-04-01 16:30-18:00', '+79052486475', 'да', 'nissan', 'almera'),
('2021-03-30 15:57', '2021-04-01 10:00-10:30', '+79035476221', 'да', 'lada', 'granta'),
('2021-03-30 16:25', '2021-04-02 10:00-12:00', '+79053498889', 'да', 'skoda', 'rapid'),
('2021-03-30 16:43', '2021-04-02 10:00-11:00', '+79271984321', 'да', 'lada', 'granta'),
('2021-03-30 17:02', '2021-04-02 11:00-12:00', '+79175421345', 'да', 'kia', 'rio'),
('2021-03-31 09:21', '2021-04-02 17:30-19:00', '+79031548791', 'да', 'lada', 'granta'),
('2021-03-31 09:55', '2021-04-02 12:00-12:30', '+79052546794', 'да', 'lada', 'granta'),
('2021-03-31 10:40', '2021-04-02 12:30-13:30', '+79271768945', 'да', 'kia', 'rio'),
('2021-03-31 11:37', '2021-04-02 13:30-14:30', '+79176578631', 'да', 'renault', 'duster'),
('2021-03-31 13:46', '2021-04-02 19:00-20:00', '+79035479862', 'да', 'lada', 'granta');

insert into sign_up_workers_services_car_categories (sign_up_id, worker_id, services_car_categories_id)
values
(1, 2, 1),
(2, 2, 12),
(3, 1, 6),
(4, 1, 10),
(5, 4, 24),
(6, 3, 33),
(7, 5, 13),
(8, 10, 28),
(9, 7, 37),
(10, 12, 1),
(11, 12, 55),
(12, 11, 13),
(13, 11, 6),
(14, 11, 24),
(15, 11, 39);