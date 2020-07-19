<?php

function validation($data){
    if(is_array($data)){
        return true;
    }else {
        return false;
    }

}

$arr = [1,2];
$ass = 'qqq';


if(validation($ass)){
    echo 'Валидацию прошли, это массив';
}
else{
    echo "Валидация не пройдена";
}
