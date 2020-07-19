<?php


namespace vendor\classes;


class TextField extends Field
{


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

