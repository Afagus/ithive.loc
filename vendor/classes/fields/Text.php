<?php


namespace nik\vendor\classes\fields;


class Text extends Field
{


    public function __construct()
    {
        parent::__construct();
    }

    public function render()
    {
        ?>
        <input type="text" name="answer" value="a1">Офицерский состав
        <?php
    }

    public function validation()
    {
        // TODO: Implement validation() method.
    }
}