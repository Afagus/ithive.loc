<?php


namespace vendor\classes;


class TextField extends Field
{

    public function __construct($form)
    {
        parent::__construct($form);

    }


    public function render()
    {
        ?>
        <input
        type="text"
        name="<?= $this->name ?>"
        value="<?= $this->value ?>"
        placeholder="<?= $this->placeholder?>">
        <?php
    }

    public function validation()
    {
        // TODO: Implement validation() method.
    }

}

