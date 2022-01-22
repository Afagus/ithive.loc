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
    public $id;
    public $message = '';
    public $field_ID = 0;


    public function __construct($form)
    {
        $this->name = $form['name'];
        $this->validation = $form['validation'];
        $this->type = $form['type'];
        $this->placeholder = isset($form['placeholder']) ? $form['placeholder'] : '';
        $this->value = $form['value'];
        $this->labelForLetter = $form['labelForLetter'];
        $this->id = $form['id'];
        $this->field_ID = isset($form['field_ID']) ? $form['field_ID'] : '';

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
                $this->message = $result['message'] ;

            }

            return $result['resultOfValid'];
        }
        return true;
    }


    abstract public function render();


    /**
     * @return string
     */
    public function createMessage()
    {
        if ($this->value) {
            return ($this->labelForLetter . ' : ' . $this->value . "\n");
        } else {
            return '';
        }

    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }



}



/**
 * подключение коллекции валидаторов полей
 */
require_once 'vendor/collectionOfValidators.php';
