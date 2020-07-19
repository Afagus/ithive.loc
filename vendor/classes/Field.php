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
//        $this->validation = $form['validation'];

     }
    abstract public function render();
    abstract public function validation();

}