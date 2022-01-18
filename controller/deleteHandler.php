<?php
require_once 'vendor/loader.php';
$createForm = \vendor\classes\PostProcessor::deleteHandler(ROUTE[1]);


$new_url = $_SERVER['HTTP_ORIGIN'].'/'.BASE."/construct/" . $_POST['idForm'];
header('Location: ' . $new_url);
exit;
