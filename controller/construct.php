<?php
require_once 'vendor/loader.php';
require_once 'content/header.php';
require_once 'content/footer.php';
?>
<h1>Конструктор формы</h1>
<?php

require_once 'vendor/DBTableInfo.php';
$tableInfo = DBTableInfo();
?>
<div id="overTable">
    <table id="tableOfFieldCreator">
        <tr><?php foreach ($tableInfo['tableTypes'] as $tableType) { ?>
            <td>Поле <b id="<?= $tableType['id'] ?>_change"><?= $tableType['name'] ?></b></td>
            <td>
                <form id="<?= $tableType['id'] ?>_delete" class="deleteField"
                      action="/<?= BASE ?>/deleteField/<?= $tableType['id'] ?>" method="post">
                    <input type="submit" value="Delete" name="delete">
                </form>
            </td>
            <td>
                <form class="changeField" action="/<?= BASE ?>/changeField/<?= $tableType['id'] ?>" method="post">
                    <input type="submit" value="Change" name="change">
                </form>
            </td>

        </tr>

        <?php }

        ?>
        <tr>
            <td><span><hr></span></td>
        </tr>
    </table>
</div>
<?php require_once "vendor/createNewField.php";
createNewField($tableInfo['typeOfFields'], $tableInfo['typeOfValidations']);

?>
<br><br><br>


<form method="post" action="/<?= BASE ?>/createHandler/<?= ROUTE[1] ?>">


    <select name="postprocessor">
        <option>Выберите обработчик</option>
        >
        <?php
        foreach (\vendor\classes\PostProcessor::getListOfReceivers() as $receiver):?>
            <option value="<?= $receiver['postprocessor_type'] ?>"><?= $receiver['postprocessor_type'] ?></option>

        <?php endforeach; ?>

    </select>

    <input type="hidden">
    <p>
        <button type="submit" class="admin_penguin"><img src="/<?= BASE ?>/images/goose.gif" alt="admin_penguin"
            ><b>Create handler</b></button>
</form>
<br>




