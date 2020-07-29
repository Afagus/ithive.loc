<?php


namespace vendor\classes;


class Select extends Field
{
public function __construct($form)
{
    parent::__construct($form);
}

    public function render()
    {
        ?>
        <select>
            <option>Пункт 1</option>
            <option>Пункт 2</option>
        </select>
        <?php
    }

    public function validation()
    {
        // TODO: Implement validation() method.
    }
}