<?php


namespace vendor\classes;


class TelegrammSender extends PostProcessor
{
    const handlersFields = [

        'preferences' => [
            'NAME' => '',

            'MESSAGE' => '',

        ]

    ];

    static public function generateFormHandler($formId, $typeHandler, $currentRoute)
    {
        $preferences = static::handlersFields['preferences'];
//TODO: Переделать конструктор под требования телеги
        ?>
        <form action="/<?= BASE ?>/saveHandler/<?= $formId ?>" method="post">
            <table style="border: 1px solid black">
                <tr>
                    <td>Enter a name of Handler</td>
                    <td>
                        <input type="text" name="titleHandler">
                    </td>
                </tr>
                <tr>
                    <td><label for="type-of-handler">Type of Handler</label></td>
                    <td><input style="Border: none; outline: none; color: red" name="type-of-handler"
                               id="type-of-handler" value="<?= $typeHandler ?>"></td>
                </tr>
                <tr>
                    <td>
                        Enter Username for SMTP
                    </td>
                    <td>
                        <input type="text" name="smtp-User">
                    </td>
                </tr>
                <tr>
                    <td>
                        Enter password for SMTP
                    </td>
                    <td>
                        <input type="password" name="smtp-password">
                    </td>
                </tr>
                <?php foreach ($preferences as $key => $field): ?>
                    <tr>
                        <td><?= $key ?></td>
                        <td> <?php self::viewListFields($key, $currentRoute); ?></td>
                    </tr>
                <?php endforeach; ?>


            </table>
            <input type="submit" name="saveHandler" value="Save">

        </form>
        <br>
        <form action="../construct/<?= $formId ?>" method="post">
            <input type="submit" name="backToForm" value="Back">
        </form>
        <?php
    }


    public function send()
    {
        $fields = $this->preferences;
//TODO: Сделать ввод токена и айди с конструктора хендлера
//В переменную $token нужно вставить токен, который нам прислал @botFather
        $token = "5027826097:AAEUInQZRZjAF60SSbsjGpGExfucbNfK2PA";

//Сюда вставляем chat_id
        $chat_id = "184377827";
//Объявляем переменную
        $txt = '';

//Определяем переменные для передачи данных из нашей формы
        if ($_POST['nameOfForm'] == $fields['NAME']) {
            $name = $this->form->getNameFieldById($fields['NAME']);
            $message = $this->form->getNameFieldById($fields['MESSAGE']);

//Собираем в массив то, что будет передаваться боту
            $arr = array(
                'Имя:' => $name,
                'Сообщение:' => $message
            );

//Настраиваем внешний вид сообщения в телеграме
            foreach ($arr as $key => $value) {
                $txt .= "<b>" . $key . "</b> " . $value . "%0A";
            };

//Передаем данные боту
            $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}", "r");

//Выводим сообщение об успешной отправке
            if (!$sendToTelegram) {
                echo('Что-то пошло не так. Попробуйте отправить форму ещё раз.');
            }

        }
    }
}