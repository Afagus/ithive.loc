<?php

spl_autoload_register('autoloader');

function autoloader($class){
$file = substr($class. '.php', 4);
require_once $file;

}

function mydebugger($data){
    echo "<hr> <br /> <b>My debugging</b></p>";
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    echo "<hr>";

}