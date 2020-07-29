<?php


namespace vendor\classes;


class TextArea extends Field
{
    public function __construct($form)
    {
        parent::__construct($form);
    }

    public function render()
    {
        ?>
        <textarea  name="textArea"></textarea></p>

        <?php
    }

    public function validation()
    {
        // TODO: Implement validation() method.
    }
}