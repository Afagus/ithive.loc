<?php
require_once 'vendor/loader.php';
?>

<h1>Выберите форму</h1>

<?php
$database = \database\singleConnect::getInstance();
$sql = 'SELECT * FROM main_form ';
$formFromQuery = $database->query($sql);

/**
 * Выводим список форм, которые находятся в базе данных в таблице main_form
 */
echo '<table>';

foreach ($formFromQuery as $value) {
    ?>
<tr>
    <td><a href="/ithive.loc/showForm/<?= $value['id'] ?>">Ссылка на
            форму <?= $value['nameOfForm'] ?> </a>
    </td>
    <td><form method="post" action="deleteForm/<?= $value['nameOfForm'] ?>">
        <input type="submit" value="delete Form" name="deleteFormButton">
            <input type="hidden" value="<?= $value['nameOfForm'] ?>">
        </form>
    </td>
</tr>
    <?php
}


echo '</table>';
