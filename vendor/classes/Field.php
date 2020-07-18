<?php


namespace nik\vendor\classes;


abstract class Field
{
    public function __construct()
    {
        /**
         * TODO make;
         */
    }
    abstract public function rendor();
    abstract public function validation();

}