<?php



$form = [

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
        'options' => ['value1' => 1,
            'value2' => 2,
            'value3' => 3],
        'validation' => ''
    ],
    'checkbox' => [

        'labelForLetter' => 'Чекбокс',
        'type' => 'Checkbox',
        'name' => 'checkbox',
        'dataForCheckbox' => [
            ['value' => 'valueOfItem1',
                'list' => 'Выбор из списка №1'],

            ['value' => 'valueOfItem2',
                'list' => 'Выбор из списка №2'],

            ['value' => 'valueOfItem3',
                'list' => 'Выбор из списка №3']
        ],
        'validation' => ''

    ],
    'radio' => [

        'labelForLetter' => 'Пол клиента',
        'validation' => '',
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
