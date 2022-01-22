<?php

require_once 'vendor/loader.php';

if (!$_POST) {
    require_once 'content/header.php';
    require_once 'content/footer.php';
}


/**
 * Отображение формы для заполнения и отправки
 */
$route = ROUTE[1];
$formOutput = \vendor\classes\Form::getSingleForm($route);

$formOutput->viewForm($_POST);


if (!$_POST) {
    ?>
    <form action="/<?= BASE ?>/construct/<?= $route ?>" method="post">
        <input type="submit" value="Изменить форму" name="changeForm">
    </form>
    <?php
    /**
     * Вывод списка сообщений из имеющихся в БД
     */

    $formFromQuery = \vendor\classes\Form::getMessageFromDB($route);

    echo '<ul id="listOfMessages">';
    foreach ($formFromQuery as $value) {
        ?>
        <li><a href="/<?= BASE ?>/showMessage/<?= $value['id'] ?>">Ссылка на сообщение <?= $value['id'] ?> от <?= $value['date'] ?> </a>
        </li>
        <?php
    }
    echo '</ul>';

}

