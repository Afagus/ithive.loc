<?php
require_once 'vendor/loader.php';
require_once 'content/header.php';
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
    <td><form method="post" action="deleteForm/<?= $value['id'] ?>">
        <input type="submit" value="delete Form" name="deleteFormButton">
            <input type="hidden" value="<?= $value['id'] ?>">
        </form>
    </td>
</tr>
    <tr>
        <td>
    <?php
}
require_once 'content/form.php';

echo '</td>';
echo '</tr>';
?>
<td><form method="post" action="gopa/1">
        <input type="submit" value="Gopa" name="gopakkkkk">
            <input type="hidden" value="gopa1">
        </form>
    </td>
        <?php
echo '</table>';
