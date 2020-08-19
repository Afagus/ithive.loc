<?php


namespace vendor\classes;


class Checkbox extends Field
{
    private $dataForCheckbox = [];
    private $title = '';

    public function __construct($form)
    {
        parent::__construct($form);
        $this->dataForCheckbox = $form['dataForCheckbox'];
        $this->title = $form['title'];
    }

    public function render()
    {
        ?>
        <p><b><?= $this->title ?></b></p>
        <p>
        <?php foreach ($this->dataForCheckbox as $item): ?>
        <input type="checkbox"
               name="<?= $this->name ?>"
               value="<?= $item['value'] ?>">
        <?= $item['list'] ?><Br>
    <?php endforeach;
    }
}