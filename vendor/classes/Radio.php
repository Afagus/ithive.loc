<?php


namespace vendor\classes;


class Radio extends Field
{
    private $nameValue = [];
    private $title = '';

    public function __construct($form)
    {
        parent::__construct($form);
        $this->nameValue = $form['nameValue'];
        $this->title = $form['title'];

    }

    public function render()
    {
        echo $this->message;
        ?>
        <p><b><?= $this->title ?></b></p>
        <div>
            <?php foreach ($this->nameValue as $item): ?>
                <input type="radio"
                       id="<?= $item['id'] ?>"
                       name="<?= $this->name ?>"
                       value="<?= $item['value'] ?>"<?=($this->value == $item['value']) ? ' checked':'';?>><?= $item['view'] ?>
            <?php endforeach; ?>
        </div>
        <?php
    }
}