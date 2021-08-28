<?php

function sendLead($name, $email, $subject, $phone)
{
// формируем URL в переменной $queryUrl
    $queryUrl = 'https://b24-78brgk.bitrix24.ua/rest/1/m6gg0gd83iwdltd9/crm.lead.add.json';
// формируем параметры для создания лида в переменной $queryData
    $queryData = http_build_query(array(
        'fields' => array(
            'TITLE' => $subject,
            'NAME' => $name,
            'EMAIL' => array(
                "n0" => array(
                    "VALUE" => "$email",
                    "VALUE_TYPE" => "WORK",
                ),
            ),
            'PHONE' => array(
                "n0" => array(
                    "VALUE" => "$phone",
                    "VALUE_TYPE" => "WORK",
                ),
            ),
        ),
        'params' => array("REGISTER_SONET_EVENT" => "Y")
    ));
// обращаемся к Битрикс24 при помощи функции curl_exec
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_POST => 1,
        CURLOPT_HEADER => 0,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $queryUrl,
        CURLOPT_POSTFIELDS => $queryData,
    ));
    $result = curl_exec($curl);
    curl_close($curl);
    $result = json_decode($result, 1);
    if (array_key_exists('error', $result)) echo "Ошибка при сохранении лида: " . $result['error_description'] .
        "<br/>";
}



