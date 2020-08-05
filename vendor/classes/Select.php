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
        ?>
        <select>
            <?php foreach ($this->options as $key=>$item): ?>
                <option value="<?= $key?>"><?= $item?></option>

            <?php endforeach; ?>
        </select>
        <?php
    }

    public function validation()
    {
        // TODO: Implement validation() method.
    }
}