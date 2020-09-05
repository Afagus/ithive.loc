<?php


namespace vendor\classes;


class Select extends Field
{
    private $options = [];

    public function __construct($form)
    {
        parent::__construct($form);
        $this->options = $form['options'];
    }


    public function render()
    {
        echo $this->message;
        ?>
        <p><select name="<?= $this->name ?>">
                <?php foreach ($this->options as $key => $value): ?>
                    <option <?= ($this->value == $key) ? 'selected ' : ''; ?>value="<?= $key ?>"><?= $value ?></option>
                <?php endforeach; ?>
            </select></p>
        <?php
    }
}