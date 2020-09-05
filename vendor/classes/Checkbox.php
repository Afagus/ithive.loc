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

    public function createMessage()
    {
        if ($this->value) {
            return ($this->labelForLetter . ' : ' . implode(', ',$this->value) . "\n");
        }else{
            return '';
        }

    }

    public function render()
    {

        echo $this->message;
        ?>
        <p><b><?= $this->title ?></b></p>
        <p>
        <?php foreach ($this->dataForCheckbox as $item): ?>
        <input type="checkbox"
               name="<?= $this->name ?>[]"
               value="<?= $item['value'] ?>"
            <?= $this->value && in_array($item['value'], $this->value) ? 'checked="checked"' : ''; ?>>
        <?= $item['list'] ?><Br>
    <?php endforeach;
    }
}