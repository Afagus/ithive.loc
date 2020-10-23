<?php

$sql = 'SELECT * FROM table_form_building 
    JOIN table_types_of_fields ttof on ttof.id_types = table_form_building.type_ID
    JOIN type_of_validation tov on tov.id_validation = table_form_building.validation_ID';

$database = \database\singleConnect::getInstance();

$form = $database->query($sql);

/**
$eee = [

    'name' => [
        'type' => 'TextField',
        'name' => 'name',
        'placeholder' => 'Enter name',
        'value' => '',
        'validation' => 'not_empty',
        'labelForLetter' => 'Имя'
    ],
    'subject' => [
        'type' => 'TextField',
        'name' => 'subject',
        'placeholder' => 'Enter subject',
        'value' => '',
        'validation' => 'not_empty',
        'labelForLetter' => 'Тема'
    ],
    'email' => [
        'type' => 'Email',
        'name' => 'email',
        'placeholder' => 'Enter e-mail',
        'value' => '',
        'validation' => 'email',
        'labelForLetter' => 'Электронная почта'

    ],
    'message' => [
        'type' => 'TextArea',
        'name' => 'message',
        'placeholder' => 'Input your message',
        'value' => '',
        'validation' => 'not_empty',
        'labelForLetter' => 'Сообщение'
    ],
    'select' => [
        'labelForLetter' => 'Выбор из выпадающего списка',
        'type' => 'Select',
        'name' => 'select',
        'options' => [
            0  =>'Выберите число',
            'value1' => 1,
            'value2' => 2,
            'value3' => 3],
        'validation' => 'select'
    ],
    'checkbox' => [
        'title' => 'Поставьте галочку',
        'labelForLetter' => 'Чекбокс',
        'type' => 'Checkbox',
        'name' => 'checkbox',
        'dataForCheckbox' => [
            ['value' => 'valueOfItem1',
            'list' => 'Check list №1'],

            ['value' => 'valueOfItem2',
            'list' => 'Check list №2'],

            ['value' => 'valueOfItem3',
            'list' => 'Check list №3']
        ],
        'validation' => 'checkbox'

    ],
    'radio' => [

        'title' => 'Укажите Ваш пол',
        'labelForLetter' => 'Пол клиента',
        'validation' => 'radio',
        'type' => 'Radio',
        'name' => 'radio',
        'nameValue' => [
            [
                'id' => 'male',
                'value' => 'male',
                'view' => 'Male'],

            [
                'id' => 'female',
                'value' => 'female',
                'view' => 'Female'],

            [
                'id' => 'other',
                'value' => 'other',
                'view' => 'Other']
        ]
    ]
];
**/

