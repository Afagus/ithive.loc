<?php


namespace vendor\classes;


class Select extends SelectorType
{
        public function render()
    {
        echo $this->message;
        ?>
        <p><b><?= $this->title ?></b></p>
        <p><select name="<?= $this->name ?>">
                <?php foreach ($this->options as $key => $value): ?>
                    <option <?= ($this->value == $key) ? 'selected ' : ''; ?>value="<?= $key ?>"><?= $value ?></option>
                <?php endforeach; ?>
            </select></p>
        <?php
    }
}