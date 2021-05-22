<?php
require_once 'vendor/loader.php';
require_once 'content/header.php';
require_once 'content/footer.php';

$qq = \vendor\classes\Form::getFromDB(ROUTE[1]);
$qq->viewForm();

?>
<form id="elForDel" action="/<?= BASE ?>/deleteMessage/<?= ROUTE[1] ?>" method="post">
        <input  type="submit" value="Удалить сообщение" name="deleteMessage">
    </form>
<?php
/*TODO сделать в JS удаление а затем возврат к форме методом back()  из JS
  * */
