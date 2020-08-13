<?php


namespace vendor\classes;


class Email extends Field
{
    public function __construct($form)
    {
        parent::__construct($form);
    }


    // TODO: Implement render() method.
        public function render()
    {
        $this->isFieldEmpty();
        ?>

        <input
            type="text"
            name="<?= $this->name?>"
            value="<?= $this->value?>""
            placeholder="<?= $this->placeholder?>">
        <?php
    }


    public function validation()
    {
        // TODO: Implement validation() method.
    }
}