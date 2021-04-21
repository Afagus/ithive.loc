<?php
require_once 'vendor/loader.php';
require_once 'content/header.php';
require_once 'content/footer.php';
require_once 'vendor/DBTableInfo.php';

$tableTypes = DBTableInfo();



$field = $tableTypes['tableField'];
$typeOfValidations = $tableTypes['typeOfValidations'];
$typeOfFields = $tableTypes['typeOfFields'];

?>

    <form id="updateField" method="post" action="/<?= BASE ?>/updateField/<?= $field[0]['id']?> ">
        <table>
            <tr>
                <td><b>Имя поля</b></td>
                <td><input type="text" name="nameField" value="<?= $field[0]['name']?>">
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
                <td><input type="text" name="placeholderField" value="<?= $field[0]['placeholder']?>">
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
                <td><input type="text" name="labelForLetterField" value="<?= $field[0]['labelForLetter']?>">
                </td>
            </tr>
            <tr>
                <td><b>Заполните поле для "Селекта, Радио или Чекбокса"</b></td>
                <td><textarea type="text" name="infoForSelect"></textarea>
                </td>
            </tr>
            <td><input  type="submit" value="Update Field" name="update"></td>
            </tr>
            <tr>
                <td>
                    <a href="/<?= BASE?>/showForm/<?= ROUTE[1] ?>">На форму</a>
                </td>
            </tr>
        </table>
    </form>
<?php