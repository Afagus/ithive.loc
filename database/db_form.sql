DROP TABLE if exists message_one_field;
DROP TABLE if exists table_form_building;
DROP TABLE if exists table_types_of_fields;
DROP TABLE if exists type_of_validation;
DROP TABLE if exists client_full_message;
DROP TABLE if exists main_form;



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
CREATE TABLE main_form
(
    id          int auto_increment
        primary key,
    nameOfForm varchar(30)
);

INSERT INTO main_form
(nameOfForm)
VALUES ('article'),
       ('second')
;

CREATE TABLE table_form_building
(
    id        int auto_increment
        primary key,
    form_ID int NOT NULL ,
    name           char(20) not null,
    type_ID           int      not null,
    placeholder    char(20) null,
    value          char(50) null,
    validation_ID     int      null,
    labelForLetter char(50) null,
    options        TEXT,
    title          char(30),

    constraint table_form_building_ibfk_1
        foreign key (type_ID) references table_types_of_fields (id_types) ON DELETE CASCADE ON UPDATE RESTRICT,
    constraint table_form_building_ibfk_2
        foreign key (validation_ID) references type_of_validation (id_validation) ON DELETE CASCADE ON UPDATE RESTRICT,
    constraint table_form_building_ibfk_3
        foreign key (form_ID) references main_form (id) ON DELETE CASCADE ON UPDATE RESTRICT
);

CREATE INDEX type
    on table_form_building (type_ID);

CREATE INDEX validation
    on table_form_building (validation_ID);

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
(form_ID, name, type_ID, placeholder, value, validation_ID, labelForLetter, options, title)
VALUES (1, 'name', 1, 'Enter name', '', 1, 'Имя', NULL, NULL),
       (1, 'subject', 1, 'Enter subject', '', 1, 'Тема', NULL, NULL),
       (1, 'email', 2, 'Enter e-mail', '', 2, 'Электронная почта', NULL, NULL),
       (1, 'message', 3, 'Input your message', '', 1, 'Сообщение', NULL, NULL),
       (1, 'select', 4, NULL, '', 3, 'Выбор из выпадающего списка',
        '{"0":"Enter value","value1":1,"value2":2,"value3":3}', NULL),
       (1, 'checkbox', 5, NULL, '', 4, 'Чекбокс',
        '{"0":{"value":"valueOfItem1","list":"Check value 1"},"1":{"value":"valueOfItem2","list":"Check value 2"},"2":{"value":"valueOfItem3","list":"Check value 3"}}',
        'Поставьте галочку'),
       (1, 'radio', 6, NULL, '', 5, 'Пол клиента', '{"0":{"id":"male","value":"male","view":"Male"},"1":{"id":"female",
"value":"female","view":"Female"},"2":{"id":"other","value":"other","view":"Other"}}', 'Укажите Ваш пол'),
        (2, 'name', 1, 'Enter name', '', 1, 'Имя', NULL, NULL),
       (2, 'subject', 1, 'Enter subject', '', 1, 'Тема', NULL, NULL),
       (2, 'email', 2, 'Enter e-mail', '', 2, 'Электронная почта', NULL, NULL),
       (2, 'message', 3, 'Input your message', '', 1, 'Сообщение', NULL, NULL),
       (2, 'select', 4, NULL, '', 3, 'Выбор из выпадающего списка',
        '{"0":"Enter value","value1":1,"value2":2,"value3":3}', NULL),
       (2, 'checkbox', 5, NULL, '', 4, 'Чекбокс',
        '{"0":{"value":"valueOfItem1","list":"Check value 1"},"1":{"value":"valueOfItem2","list":"Check value 2"},"2":{"value":"valueOfItem3","list":"Check value 3"}}',
        'Поставьте галочку'),
       (2, 'radio', 6, NULL, '', 5, 'Пол клиента', '{"0":{"id":"male","value":"male","view":"Male"},"1":{"id":"female",
"value":"female","view":"Female"},"2":{"id":"other","value":"other","view":"Other"}}', 'Укажите Ваш пол');



CREATE TABLE client_full_message
(
    id      int auto_increment primary key,
    form_ID int ,
    message TEXT,
    date DATETIME DEFAULT CURRENT_TIMESTAMP ,

    constraint client_full_message_ibfk_1
        foreign key (form_ID) references main_form (id)
);

CREATE TABLE  message_one_field
(
    id int auto_increment primary key,
    message_ID int,
    field_ID int,
    value TEXT,

        constraint message_one_field_ibfk_1
        foreign key (field_ID) references table_form_building (id),
        constraint message_one_field_ibfk_2
        foreign key (message_ID) references client_full_message (id)

);