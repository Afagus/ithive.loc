<?php


namespace vendor\classes;


class Radio extends SelectorType
{
    public function render()
    {
        echo $this->message;

        ?>
        <p><b><?= $this->title ?></b></p>
        <div>
            <?php foreach ($this->options as $key=>$item): ?>
                <input type="radio"
                       id="<?= $key ?>"
                       name="<?= $this->name ?>"
                       value="<?= $item ?>"<?=($this->value == $item) ? ' checked':'';?>><?= $item ?>
            <?php endforeach; ?>
        </div>
        <?php
    }
}