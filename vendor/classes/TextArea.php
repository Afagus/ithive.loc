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
        $this->isFieldEmpty();
        ?>

        <textarea name="<?=$this->name?>"
                  placeholder="<?= $this->placeholder ?>"><?=$this->value?></textarea></p>

        <?php
    }

    public function validation()
    {


    }
}