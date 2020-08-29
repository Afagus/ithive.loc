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
        mydebugger($this);
        echo $this->message;
        ?>
        <p><b><?= $this->title ?></b></p>
        <p>
        <?php foreach ($this->dataForCheckbox as $item): ?>
        <input type="checkbox"
               name="<?= $this->name ?>[]"
               value="<?= $item['value'] ?>"
            <?= in_array($item['value'], $this->dataForCheckbox) ? 'checked="checked"' : ''; ?>>
        <?= $item['list'] ?><Br>
    <?php endforeach;
    }
}