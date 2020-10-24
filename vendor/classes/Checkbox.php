<?php


namespace vendor\classes;


class Checkbox extends Field
{
    private $options = [];
    private $title = '';

    public function __construct($form)
    {
        parent::__construct($form);
        $this->options = json_decode($form['options'], JSON_FORCE_OBJECT);
        $this->title = $form['title'];
    }

    public function createMessage()
    {
        if ($this->value) {
            return ($this->labelForLetter . ' : ' . implode(', ', $this->value) . "\n");
        } else {
            return '';
        }

    }

    public function render()
    {

        echo $this->message;
        ?>
        <p><b><?= $this->title ?></b></p>
        <p>
        <?php foreach ($this->options as $item): ?>
        <input type="checkbox"
               name="<?= $this->name ?>[]"
               value="<?= $item['value'] ?>"
            <?= $this->value && in_array($item['value'], (is_array($this->value)?$this->value : json_decode($this->value, JSON_FORCE_OBJECT))) ? 'checked="checked"' : '';?>>
        <?= $item['list'] ?><Br>
    <?php endforeach;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        if ($this->value) {
            return json_encode($this->value, JSON_FORCE_OBJECT);
        } else {
            return '';
        }
    }
}