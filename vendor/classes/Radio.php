<?php


namespace vendor\classes;


class Radio extends Field
{
    public function __construct($form)
    {
        parent::__construct($form);
    }

    public function render()
    {
        ?>
        <p><b>В каких годах произошли самые известные извержения вулкана Кракатау?</b></p>
        <p><input type="checkbox" name="a" value="1417"> 1417</p>
        <p><input type="checkbox" name="a" value="1680" checked> 1680</p>
        <p><input type="checkbox" name="a" value="1883" checked> 1883</p>
        <p><input type="checkbox" name="a" value="1934"> 1934</p>
        <p><input type="checkbox" name="a" value="2010"> 2010</p>
        <?php
    }

    public function validation()
    {
        // TODO: Implement validation() method.
    }
}