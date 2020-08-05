<?php


namespace vendor\classes;


class Checkbox extends Field
{
    private $dataForCheckbox = [];

    public function __construct($form)
    {
        parent::__construct($form);
        $this->dataForCheckbox = $form['dataForCheckbox'];
    }

    public function render()
    {
        ?>
        <p><b>Поставьте галочки, где считаете нужным</b></p>
        <p>
        <?php foreach ($this->dataForCheckbox as $item): ?>
        <input type="checkbox" name="<?= $this->name ?>" value="<?= $item['value'] ?>>"><?= $item['list'] ?><Br>
    <?php endforeach;

    }

    public function validation()
    {
        // TODO: Implement validation() method.
    }
}