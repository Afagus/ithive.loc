<?php


namespace nik\vendor\classes;


class Text extends Field
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
                value="<?= $this->value ?>">Something
        <?php
    }

    public function validation()
    {
        // TODO: Implement validation() method.
    }

}

