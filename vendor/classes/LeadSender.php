<?php


namespace vendor\classes;


class LeadSender extends PostProcessor
{
    public $name;
    public $email;
    public $subject;
    public $message;
    public $phone;
    public $url = 'https://b24-owmhqi.bitrix24.ua/rest/1/9zvysf6apwynveis/crm.lead.add.json';

    public function __construct($getForm, $getPostProc)
    {
        $this->name = $getForm->currentValue['name'];
        $this->email = $getForm->currentValue['email'];
        $this->subject = $getForm->currentValue['subject'];
        $this->message = $getForm->currentValue['message'];
        $this->phone = $getForm->currentValue['phone']?:'';
    }

    public function send()
    {

    $queryUrl = $this->url;
// формируем параметры для создания лида в переменной $queryData
    $queryData = http_build_query(array(
        'fields' => array(
            'TITLE' => "$this->subject",
            'NAME' => "$this->name",
            'EMAIL' => array(
                "n0" => array(
                    "VALUE" => "$this->email",
                    "VALUE_TYPE" => "WORK",
                ),
            ),
            'PHONE' => array(
                "n0" => array(
                    "VALUE" => "$this->phone",
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
}