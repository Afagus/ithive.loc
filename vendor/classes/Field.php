<?php


namespace vendor\classes;


abstract class Field
{
    public $type;
    public $name;
    public $placeholder;
    public $value;
    public $validation;
    public $labelForLetter;


    public function __construct($form)
    {
        $this->name = $form['name'];
        $this->validation = $form['validation'];
        $this->type = $form['type'];
        $this->placeholder = isset($form['placeholder']) ? $form['placeholder'] : '';
        $this->value = isset($_POST[$this->name]) ? $_POST[$this->name  ] : '';
        $this->labelForLetter = $form['labelForLetter'];

    }

    abstract public function render();

    public function isFieldEmpty()
    {

        if (empty(!$_POST) && empty($this->value)) {
            echo 'The field is empty' .'<br>';
        }


    }


}