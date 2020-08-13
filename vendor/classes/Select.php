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
        <p><select size="3" name="<?=$this->name?>">
                <option disabled>Выберите героя</option>
                <option value="t1" selected>Чебурашка</option>
                <option value="t2">Крокодил Гена</option>
                <option value="t3">Шапокляк</option>
                <option value="t4">Крыса Лариса</option>
            </select></p>
        <?php
    }

    public function validation()
    {
        // TODO: Implement validation() method.
    }
}