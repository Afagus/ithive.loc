<?php


namespace vendor\classes;


class Radio extends Field
{
    private $nameValue = [];

    public function __construct($form)
    {
        parent::__construct($form);
        $this->nameValue = $form['nameValue'];

    }

    public function render()
    {
        ?>
        <p>Please select your preferred contact method:</p>
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