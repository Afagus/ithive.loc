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
        <tr>
            <td><p>Выберите возможного получателя данных: </p></td>
        </tr>
        <tr>
            <td>
                <form action="#">
                    <?php
                    /** Макет-прототип--нужно менять  в JS расположение ------------------------------------------------------------
                     */

                    foreach (\vendor\classes\PostProcessor::getListOfReceivers() as $receiver):?>

                        <input type="checkbox"
                               name=""
                               value=""><?php echo $receiver['receiver_type'] ?><br/>
                    <?php endforeach;
                    /**
                     * __________________________________________________________________________________________________________
                     */
                    ?>
                    <input type="submit" value="Сохранить получателей" name="receiver">
                </form>
            </td>
        </tr>
        <tr>
            <td><span><hr></span></td>
        </tr>
    </table>
</div>
<?php require_once "vendor/createNewField.php";
createNewField($tableInfo['typeOfFields'], $tableInfo['typeOfValidations']);

?>
<br>
<br>


