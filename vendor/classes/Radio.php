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
        ?>
        <p><b><?= $this->title ?></b></p>
        <div>
            <?php foreach ($this->nameValue as $item): ?>
                <input type="radio"
                       id="<?= $item['id'] ?>"
                       name="<?= $this->name ?>"
                       value="<?= $item['value'] ?>"><?= $item['view'] ?>
            <?php endforeach; ?>
        </div>
        <?php
    }

    public function validation()
    {
// TODO: Implement validation() method.
    }
}