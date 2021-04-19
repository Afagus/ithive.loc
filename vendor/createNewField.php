<?php

function createNewField($typeOfFields, $typeOfValidations)
{

    ?>
    <form id="addField" method="post" action="/<?= BASE ?>/createField/<?= ROUTE[1] ?> ">
        <table>

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
            <tr>
                <td>
                    <a href="/<?= BASE ?>/showForm/<?= ROUTE[1] ?>">На форму</a>
                </td>
            </tr>
        </table>
    </form>
    <?php

}
