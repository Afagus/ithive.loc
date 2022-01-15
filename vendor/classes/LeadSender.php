<?php


namespace vendor\classes;


/**
 * Class LeadSender
 * @package vendor\classes
 * Класс постобработчика, отвечающий за отправку сообщения в виде лида в  CRM Битрикс24
 */
class LeadSender extends PostProcessor
{

    const handlersFields = [

        'preferences' => [
            'NAME' => 'name',
            'EMAIL' => 'email',
            'PHONE' => 'phone',
            'MESSAGE' => 'message',
            'SUBJECT' => 'subject',
            'TITLE' => 'title']

    ];
    public $url = 'https://b24-owmhqi.bitrix24.ua/rest/1/9zvysf6apwynveis/crm.lead.add.json';


    /**
     *Метод отправки лида в Битрикс24
     */
    public function send()
    {
        $fields = $this->preferences['fields'];
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

    static public function generateFormHandler($itemId, $typeHandler)
    {
        $preferences = static::handlersFields['preferences'];

        ?>
        <form action="/<?= BASE ?>/saveHandler/<?= $itemId ?>" method="post">
            <table style="border: 1px solid black">
                <tr>
                    <td><label for="titleHandler">Enter a name of Handler</label></td>
                    <td>
                        <input type="text" name="titleHandler" id="titleHandler">
                    </td>
                </tr>
                <tr>
                    <td><label for="type-of-handler">Type of Handler</label></td>
                    <td><input style="Border: none; outline: none; color: red" name="type-of-handler" id="type-of-handler" value="<?= $typeHandler ?>"></td>
                </tr>
                <tr>
                    <td>
                    <label for="lead-url">Input URL</label></td>
                     </td>
                    <td>
                        <input type="text" name="lead-url" id="lead-url">
                    </td>
                </tr>
                <?php foreach ($preferences as $key => $field): ?>
                    <tr>
                        <td><label for="<?= $key?>"><?= $key ?></label></td>
                        <td><?php self::viewListFields($key);?></td>
                    </tr>
                <?php endforeach; ?>


            </table>
            <input type="submit" value="Save">

        </form>
        <br>
        <form action="../construct/<?= $itemId ?>" method="post">
            <input type="submit" name="backToForm" value="Back">
        </form>
        <?php
    }

}