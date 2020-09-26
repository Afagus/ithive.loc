<?php
/**
 * @param $value
 * Создание массива с функциями валидаций под все возможные типы
 * @return array
 * с результатом по валидации и сообщением для пользователя
 */

use vendor\classes\Field;


/**
 * @param $value
 * @return array
 * валидатор поля с признаком 'not_empty'
 */
Field::$listOfValidators['not_empty'] = function ($value) {

    return [
        'resultOfValid' => (bool)$value,
        'message' => '<span style="color: red">The field is empty or not correct</span>'
    ];
};


/**
 * @param $value
 * @return array
 * валидатор поля с признаком 'e-mail'
 */
Field::$listOfValidators['email'] = function ($value) {

    return [
        'resultOfValid' => (bool)$value,
        'message' => '<span style="color: red">The field is empty or not correct</span>'
    ];
};


/**
 * @param $value
 * @return array
 * валидатор поля  с признаком 'radio'
 */

Field::$listOfValidators['radio'] = function ($value) {

    return [
        'resultOfValid' => (bool)$value,
        'message' => '<span style="color: red">The field is empty or not correct</span>'
    ];
};

/**
 * @param $value
 * @return array
 * валидатор поля  с признаком 'select'
 */

Field::$listOfValidators['select'] = function ($value) {

    return [
        'resultOfValid' => (bool)$value,
        'message' => '<span style="color: red">The field is empty or not correct</span>'
    ];
};
/**
 * @param $value
 * @return array
 * валидатор поля  с признаком 'checkbox'
 */

Field::$listOfValidators['checkbox'] = function ($value) {

    return [
        'resultOfValid' => (bool)$value,
        'message' => '<span style="color: red">The field is empty or not correct</span>'
    ];
};

