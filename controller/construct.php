<?php
require_once 'vendor/loader.php';
require_once 'content/header.php';
?>
<h1>Конструктор формы</h1>
<?php

require_once 'vendor/DBTableInfo.php';
$tableInfo= DBTableInfo();
?>
<table>
    <tr><?php foreach ($tableInfo['tableTypes']

        as $tableType) { ?>
        <td><?= 'Поле ' . '<b>' . $tableType['name'] . '</b>'; ?></td>
        <td>
            <form action="/ithive.loc/deleteField/<?= $tableType['id'] ?>" method="post">
                <input type="submit" value="Delete" name="delete">
            </form>
        </td>
        <td>
            <form action="/ithive.loc/changeField/<?= $tableType['id'] ?>" method="post">
                <input type="submit" value="Change" name="change">
            </form>
        </td>
    </tr>
    <?php }

    ?>
</table>
<?php require_once "vendor/createNewField.php";
createNewField($tableInfo['typeOfFields'], $tableInfo['typeOfValidations']);
?>
<br>
<br>


