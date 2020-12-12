<?php


namespace vendor\classes;


abstract class SelectorType extends Field
{
    protected $options = [];
    protected $title = '';

    public function __construct($form)
    {
        parent::__construct($form);
        $this->options = json_decode($form['options'], JSON_FORCE_OBJECT);
        $this->title = $form['title'];
    }

}