<?php


namespace vendor\classes;


class Select extends Field
{
    private $options = [];

    public function __construct($form)
    {
        parent::__construct($form);
        $this->options = json_decode($form['options'], JSON_FORCE_OBJECT);

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