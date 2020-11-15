<?php

spl_autoload_register('autoloader');


function autoloader($class){
$file = $class . ".php" ;

require_once $file;
}




function mydebugger($data){
    echo "<hr> <br /> <b>My debugging</b></p>";

    echo '<pre>';
    print_r($data);
    echo '</pre>';
    echo "<hr>";

}