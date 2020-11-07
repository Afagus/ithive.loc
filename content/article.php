<?php
require_once 'vendor/classes/Form.php';

if (!$_GET) {
    ?>
    <h1>Вас приветствует панель Администратора</h1>

    <?php
    $database = \database\singleConnect::getInstance();
    $sql = 'SELECT * FROM main_form ';
    $formFromQuery = $database->query($sql);

    /**
     * Выводим список форм, которые находятся в базе данных в таблице main_form
     */
    echo '<ul>';
    foreach ($formFromQuery as $value) {
        ?>
        <li><a href="/ithive.loc/index.php?showForm=<?= $value['id'] ?>">Ссылка на
                форму <?= $value['nameOfForm'] ?> </a></li>
        <?php
    }
    echo '</ul>';
}
/**
 * TODO: check & kill the Notice
 *Если в строке запроса есть переданное значение с ключом 'showForm'
 *
 **/
if (key_exists('showForm', $_GET)) {

    /**
     * Вывод сообщения при переходе из списка сообщений
     */
    if (key_exists('showMessage' , $_GET)) {
        $qq = \vendor\classes\Form::getFromDB($_GET['showMessage'], $_GET['showForm']);
        $qq->viewForm();


    } else {

        $formOutput = \vendor\classes\Form::getSingleForm($_GET['showForm']);
        $formOutput->viewForm();

    }
    $database = \database\singleConnect::getInstance();
    $sql = 'SELECT * 
                FROM client_full_message
                WHERE form_ID = ' . $_GET['showForm'];
    /**
     * Вывод списка сообщений из имеющихся в БД
     */
    $formFromQuery = $database->query($sql);
    echo '<ul>';
    foreach ($formFromQuery as $value) {
        ?>
        <li><a href="/ithive.loc/index.php?showMessage=<?= $value['id'] ?>&showForm=<?= $_GET['showForm'] ?>">Ссылка
                на сообщение <?= $value['id'] ?> от <?= $value['date'] ?> </a></li>
        <?php
    }
    echo '</ul>';


}

?>
<form action="">
<input type="submit" value="construct" name="keyConstr">
</form>

<?php
if (key_exists('keyConstr',$_GET)){

$viewConstr = new \vendor\classes\ConstructorForm();
$viewConstr->viewerConstr();
}








