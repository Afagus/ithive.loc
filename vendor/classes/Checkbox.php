<?php


namespace vendor\classes;


class Checkbox extends Field
{
    public function __construct($form)
    {
        parent::__construct($form);
    }

    public function render()
    {
        ?>
        <p><b>С какими операционными системами вы знакомы?</b></p>
        <p>  <input type="checkbox" name="option1" value="a1" checked>Windows 95/98<Br>
            <input type="checkbox" name="option2" value="a2">Windows 2000<Br>
            <input type="checkbox" name="option3" value="a3">System X<Br>
            <input type="checkbox" name="option4" value="a4">Linux<Br>
            <input type="checkbox" name="option5" value="a5">X3-DOS</p>

        <?php
    }

    public function validation()
    {
        // TODO: Implement validation() method.
    }
}