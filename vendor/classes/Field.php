<?php


namespace vendor\classes;


abstract class Field
{

    public static $listOfValidators = [];
    /**
     * @var string
     */


    public $type;
    public $name;
    public $placeholder;
    public $value;
    public $validation;
    public $labelForLetter;

    public $message = '';


    public function __construct($form)
    {
        $this->name = $form['name'];
        $this->validation = $form['validation'];
        $this->type = $form['type'];
        $this->placeholder = isset($form['placeholder']) ? $form['placeholder'] : '';
        $this->value =  $form['value'];
        $this->labelForLetter = $form['labelForLetter'];

    }

    /**
     * @return bool|mixed
     * валидация поля, которая записывает в переменную результат отработки функции, в виде массива
     *и возвращает булевое выражение, также при "false" записывает в свойство $message текст ошибки
     */
    public function validate()
    {
        if ($this->validation) {
            $result = (self::$listOfValidators[$this->validation])($this->value);
            if (!$result['resultOfValid']) {
                $this->message = $result['message'].'<br>';
            }
            return $result['resultOfValid'];
        }
        return true;
    }


    abstract public function render();


}

/**
 * @param $value
 * Создание массива с функциями валидаций под все возможные типы
 * @return array
 * с результатом по валидации и сообщением для пользователя
 */

Field::$listOfValidators['not_empty'] = function ($value) {

    return [
        'resultOfValid' => (bool)$value,
        'message' => 'The field is empty or not correct'
    ];
};

Field::$listOfValidators['email'] = function ($value) {

    return [
        'resultOfValid' => (bool)$value,
        'message' => 'The field is empty or not correct'
    ];
};