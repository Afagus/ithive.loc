<?php


namespace vendor\classes;


/**
 * Class LeadSender
 * @package vendor\classes
 * Класс постобработчика, отвечающий за отправку сообщения в виде лида в  CRM Битрикс24
 */
class LeadSender extends PostProcessor
{

    public $url = 'https://b24-owmhqi.bitrix24.ua/rest/1/9zvysf6apwynveis/crm.lead.add.json';





    /**
     *Метод отправки лида в Битрикс24
     */
    public function send()
    {
        $fields = $this->preferenses['fields'];
        $queryUrl = $this->url;
// формируем параметры для создания лида в переменной $queryData
        $queryData = http_build_query(array(
            'fields' => array(
                'TITLE' => $this->form->currentValue[$fields['TITLE']],
                'NAME' => $this->form->currentValue[$fields['NAME']],
                'EMAIL' => array(
                    "n0" => array(
                        "VALUE" => $this->form->currentValue[$fields['EMAIL']],
                        "VALUE_TYPE" => "WORK",
                    ),
                ),
                'PHONE' => array(
                    "n0" => array(
                        "VALUE" => $this->form->currentValue[$fields['PHONE']],
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