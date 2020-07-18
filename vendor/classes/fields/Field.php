<?php


namespace nik\vendor\classes\fields;


abstract class Field
{
    public function __construct()
    {
        /**
         * TODO make;
         */
    }
    abstract public function render();
    abstract public function validation();

}