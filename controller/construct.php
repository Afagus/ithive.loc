<?php
require_once 'vendor/loader.php';
require_once 'content/header.php';
?>
<h1>Конструктор формы</h1>
<?php

$database = \database\singleConnect::getInstance();
$sqlChecked = 'SELECT * FROM form.table_form_building
        WHERE form_ID = ' . ROUTE[1];
$sqlTypesOfFields = 'SELECT * FROM form.table_types_of_fields';
$sqlTypesOfValidation = 'SELECT * FROM form.type_of_validation';

$tableTypes = $database->query($sqlChecked);
$typeOfFields = $database->query($sqlTypesOfFields);
$typeOfValidations = $database->query($sqlTypesOfValidation);

?>
<table>
    <tr><?php foreach ($tableTypes

        as $tableType) { ?>
        <td><?= 'Тип поля ' . '<b>' . $tableType['name'] . '</b>'; ?></td>
        <td>
            <form action="/ithive.loc/deleteField/<?= $tableType['id'] ?>" method="post">
                <input type="submit" value="Delete" name="delete">
            </form>
        </td>
    </tr>
    <?php }

    ?>
    <form method="post" action="<?= BASE ?>/createField/<?= ROUTE[1] ?> ">
        <tr>
            <td><b>Имя поля</b></td>
            <td><input type="text" name="nameField">
            </td>
        </tr>

        <tr>
            <td><b>Тип поля</b></td>
            <td><select name="typeField">
                    <?php foreach ($typeOfFields as $typeOfField): ?>
                        <option value="<?= $typeOfField['id_types'] ?>">
                            <?= $typeOfField['type']; ?>
                        </option>
                    <?php endforeach; ?>
                </select></td>
        </tr>
        <tr>
            <td><b>Плейсхолдер поля</b></td>
            <td><input type="text" name="placeholderField">
            </td>
        </tr>
        <tr>
            <td><b>Тип валидации</b></td>
            <td><select name="validationField">
                    <?php foreach ($typeOfValidations as $typeOfValidation): ?>
                        <option value="<?= $typeOfValidation['id_validation'] ?>">
                            <?= $typeOfValidation['validation']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td><b>Пометка для письма</b></td>
            <td><input type="text" name="labelForLetterField">
            </td>
        </tr>
        <tr>
            <td><b>Заполните поле для "Селекта, Радио или Чекбокса"</b></td>
            <td><textarea type="text" name="infoForSelect"></textarea>
            </td>
        </tr>
        <td><input type="submit" value="add field" name="create"></td>
        </tr>
    </form>
    <tr>
        <td>
            <a href="/ithive.loc/showForm/<?= ROUTE[1] ?>">На форму</a>
        </td>
    </tr>
    </form>
</table>
<br>
<br>


