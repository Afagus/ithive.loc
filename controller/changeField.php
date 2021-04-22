<?php
//require_once 'vendor/loader.php';
//require_once 'content/header.php';
//require_once 'content/footer.php';
require_once 'vendor/DBTableInfo.php';

$tableTypes = DBTableInfo();



$field = $tableTypes['tableField'];
$typeOfValidations = $tableTypes['typeOfValidations'];
$typeOfFields = $tableTypes['typeOfFields'];
//mydebugger($tableTypes);

?>

    <form id="updateField" method="post" action="/<?= BASE ?>/updateField/<?= $field[0]['id']?> ">
        <table>
            <tr>
                <td><b>Имя поля</b></td>
                <td><input id="nameField" type="text" name="nameField" value="<?= $field[0]['name']?>">
                </td>
            </tr>

            <tr>
                <td><b>Тип поля</b></td>
                <td><select id="typeField" name="typeField">
                        <?php foreach ($typeOfFields as $typeOfField): ?>
                            <option value="<?= $typeOfField['id_types'] ?>">
                                <?= $typeOfField['type']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select></td>
            </tr>
            <tr>
                <td><b>Плейсхолдер поля</b></td>
                <td><input id ="placeholderField" type="text" name="placeholderField" value="<?= $field[0]['placeholder']?>">
                </td>
            </tr>
            <tr>
                <td><b>Тип валидации</b></td>
                <td><select id="validationField" name="validationField">
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
                <td><input id="labelForLetterField" type="text" name="labelForLetterField" value="<?= $field[0]['labelForLetter']?>">
                </td>
            </tr>
            <tr>
                <td><b>Заполните поле для "Селекта, Радио или Чекбокса"</b></td>
                <td><textarea id="infoForSelect" type="text" name="infoForSelect"></textarea>
                </td>
            </tr>
            <td><input  type="submit" value="Update Field" name="update"></td>
            </tr>
        </table>
    </form>
<?php