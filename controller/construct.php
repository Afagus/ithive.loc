<?php
require_once 'vendor/loader.php';
require_once 'content/header.php';
require_once 'content/footer.php';
require_once 'vendor/DBTableInfo.php';
?>
<h1>Конструктор формы</h1>
<?php

$tableInfo = DBTableInfo();
$currentRoute = ROUTE[1];
?>
<div id="overTable">
    <table id="tableOfFieldCreator">
        <th>List of Fields</th>
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
    <table id="tableOfHandleCreator">
        <th>List of Handlers</th>
        <?php if (empty(\vendor\classes\PostProcessor::getReceivers($currentRoute))) {
            echo '<tr><td style="color: red">';
            echo 'Please add Handler';
            echo '<td><tr>';
        }; ?>

        <?php foreach (\vendor\classes\PostProcessor::getReceivers($currentRoute) as $handler): ?>
            <tr>
                <td><?= $handler['title']; ?></td>
                <td>
                    <form id="<?= $handler['id'] ?>_delete_handler" class="deleteHandler"
                          action="/<?= BASE ?>/deleteHandler/<?= $handler['id'] ?>" method="post">
                        <input type="submit" value="Delete" name="delete">
                        <input type="hidden" value="<?= $handler['form']; ?>" name="idForm">
                    </form>
                </td>
                <td>
                    <form action="/<?= BASE ?>/editHandler/<?= $handler['id'] ?>" method="post">
                        <input type="submit" value="edit" name="edit">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        <td><span><hr></span></td>
    </table>
</div>
<?php require_once "vendor/createNewField.php";
createNewField($tableInfo['typeOfFields'], $tableInfo['typeOfValidations']);

?>
<br><br><br>


<form method="post" action="/<?= BASE ?>/createHandler/<?= $currentRoute ?>">
    <div>
        <p><b>Choose Handler</b></p>
        <div style="display: flex">
            <select name="postprocessor">
                <?php
                foreach (\vendor\classes\PostProcessor::getRecieversList() as $receiver):?>
                    <option value="<?= $receiver['postprocessor_type'] ?>"><?= $receiver['postprocessor_type'] ?></option>
                <?php endforeach; ?>
            </select>

            <input type="hidden">

            <button type="submit" class="admin_penguin"><img src="/<?= BASE ?>/images/goose.gif" alt="admin_penguin"
                ><b>Create handler</b></button>
        </div>
    </div>
</form>
<br>




