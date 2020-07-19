<?php


namespace nik\vendor\classes;


abstract class Field
{
    public $form;
    public $type;
    public $name;
    public $placeholder;
    public $value;
    public $validation;
    public $labelForLetter;


    public function __construct($form)
    {
        $this->form = $form;
//        $this->name = $form['name'];
//        $this->placeholder = $form['placeholder'];
//        $this->validation = $form['validation'];
//        $this->labelForLetter = $form['labelForLetter'];
//        $this->type = $form['type'];
//        $this->value = empty(!$_POST['value'])? $_POST['value'] : '';
    }
    abstract public function render();
    abstract public function validation();

}