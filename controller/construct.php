<?php
require_once 'vendor/loader.php';
require_once 'content/header.php';
require_once 'content/footer.php';
?>
<h1>Конструктор формы</h1>
<?php

require_once 'vendor/DBTableInfo.php';
$tableInfo= DBTableInfo();
?>
<table id="tableOfFieldCreator">
    <tr><?php foreach ($tableInfo['tableTypes']

        as $tableType) { ?>
        <td><?= 'Поле ' . '<b>' . $tableType['name'] . '</b>'; ?></td>
        <td>
            <form action="/<?=BASE?>/deleteField/<?= $tableType['id'] ?>" method="post">
                <input type="submit" value="Delete" name="delete">
            </form>
        </td>
        <td>
            <form action="/<?=BASE?>/changeField/<?= $tableType['id'] ?>" method="post">
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


