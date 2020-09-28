<?php


namespace vendor\classes;


class Radio extends Field
{
    private $options = [];
    private $title = '';

    public function __construct($form)
    {
        parent::__construct($form);
        $this->options = json_decode($form['options'], JSON_FORCE_OBJECT);
        $this->title = $form['title'];

    }

    public function render()
    {
        echo $this->message;

        ?>
        <p><b><?= $this->title ?></b></p>
        <div>
            <?php foreach ($this->options as $item): ?>
                <input type="radio"
                       id="<?= $item['id'] ?>"
                       name="<?= $this->name ?>"
                       value="<?= $item['value'] ?>"<?=($this->value == $item['value']) ? ' checked':'';?>><?= $item['view'] ?>
            <?php endforeach; ?>
        </div>
        <?php
    }
}