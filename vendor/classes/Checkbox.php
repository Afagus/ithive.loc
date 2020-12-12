<?php


namespace vendor\classes;


class Checkbox extends SelectorType
{

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
        <?php foreach ($this->options as $key => $item): ?>
        <input type="checkbox"
               name="<?= $this->name ?>[]"
               value="<?= $key?>"
            <?= $this->value && in_array($item, (is_array($this->value) ? $this->value : (json_decode($this->value, JSON_FORCE_OBJECT)))) ? 'checked="checked"' : ''; ?>>
        <?= $item ?><Br>
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