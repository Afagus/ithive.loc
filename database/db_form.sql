DROP TABLE if exists table_form_building;
DROP TABLE if exists table_types_of_fields;
DROP TABLE if exists type_of_validation;



CREATE TABLE table_types_of_fields
(
    id_types int auto_increment
        primary key,
    type     char(30) null
);

CREATE TABLE type_of_validation
(
    id_validation int auto_increment
        primary key,
    validation    char(20) not null
);

CREATE TABLE table_form_building
(
    id_form        int auto_increment
        primary key,
    name           char(20) not null,
    type           int      not null,
    placeholder    char(20) null,
    value          char(50) null,
    validation     int      null,
    labelForLetter char(50) null,
    constraint table_form_building_ibfk_1
        foreign key (type) references table_types_of_fields (id_types),
    constraint table_form_building_ibfk_2
        foreign key (validation) references type_of_validation (id_validation)
);

CREATE INDEX type
    on table_form_building (type);

CREATE INDEX validation
    on table_form_building (validation);

INSERT INTO table_types_of_fields
    (type)
VALUES ('TextField'),
       ('Email'),
       ('TextArea'),
       ('Select'),
       ('Checkbox'),
       ('Radio');

INSERT INTO type_of_validation
    (validation)
VALUES ('not_empty'),
       ('email'),
       ('select'),
       ('checkbox'),
       ('radio');

INSERT INTO table_form_building
    (name, type, placeholder, value, validation, labelForLetter)
VALUES ('name', 1, 'Enter name', '', 1, 'Имя'),
       ('subject', 1, 'Enter subject', '', 1, 'Тема'),
       ('email', 2, 'Enter e-mail', '', 2, 'Электронная почта'),
       ('message', 3, 'Input your message', '', 1, 'Сообщение'),
       ('select', 4, NULL, '', 3, 'Выбор из выпадающего списка'),
       ('checkbox', 5, NULL, '', 4, 'Чекбокс'),
       ('radio', 6, NULL, '', 5, 'Пол клиента');

