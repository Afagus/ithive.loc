<?php

require_once 'vendor/loader.php';

if (!$_POST) {
    require_once 'content/header.php';
    require_once 'content/footer.php';
}


$formOutput = \vendor\classes\Form::getSingleForm(ROUTE[1]);
$formOutput->viewForm($_POST);


if (!$_POST) {
    /**
     * Вывод списка сообщений из имеющихся в БД
     */
    $database = \database\singleConnect::getInstance();
    $sql = 'SELECT * 
                FROM client_full_message
                WHERE form_ID = ' . ROUTE[1];

    $formFromQuery = $database->query($sql);


    echo '<ul id="listOfMessages">';
    foreach ($formFromQuery as $value) {
        ?>
        <li><a href="/<?= BASE ?>/showMessage/<?= $value['id'] ?>">Ссылка
                на сообщение <?= $value['id'] ?> от <?= $value['date'] ?> </a>
        </li>
        <?php
    }
    echo '</ul>';

    ?>
    <form action="/<?= BASE ?>/construct/<?= ROUTE[1] ?>" method="post">
        <input type="submit" value="Change form" name="changeForm">
    </form>
<?php }

