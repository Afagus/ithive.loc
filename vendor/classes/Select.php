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
        <p><select name="<?= $this->name ?>">
                <option disabled>Выберите число</option>
                <?php foreach ($this->options as $key => $value): ?>
                <option value="<?= $key ?>"><?= $value ?></option>
                <?php endforeach; ?>
            </select></p>
        <?php
    }
}