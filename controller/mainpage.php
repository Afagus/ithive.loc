<?php
require_once 'vendor/loader.php';
require_once 'content/header.php';
require_once 'router/router.php';
require_once 'content/footer.php';


echo "<h1>Выберите форму</h1>";


/**
 * Выводим список форм, которые находятся в базе данных в таблице main_form
 */
$formFromQuery = \vendor\classes\Form::getListOfForms();

require_once 'content/form.php';
echo '<table id="myTable">';

foreach ($formFromQuery as $value) {
    ?>
    <tr>
        <td><a href="/<?= BASE ?>/showForm/<?= $value['id'] ?>">Ссылка на
                форму <?= $value['nameOfForm'] ?></a>
        </td>
        <td>
            <form class="deleteFormButton" method="post" action="deleteForm/<?= $value['id'] ?>">
                <input type="submit" value="delete Form" name="deleteFormButton">
                <input type="hidden" value="<?= $value['id'] ?>">
            </form>
        </td>

    </tr>
    <tr>

    </tr>
    <?php
}

echo '</table>';

echo '<form name="admin" method="post" action="createHandler">
<div class="admin;" style="text-align: end">
            
            
            
      </div>
</form';

