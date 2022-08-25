<?php
    // Токен
    const TOKEN = '5323795750:AAEy4oymYlhXJgKb4tdCsIn1dPgsqBfr8aM';

//1 ID чата
const CHATID = '667407369';

//2 ID чата
const CHATID2 = '';

   $users = [CHATID,CHATID2];

    $name = $_POST['name'] ?? null;
    require_once "database/DB.php";
    if(DB::addDownload($name)) {
        $message =
        "Мамонт скачал: $name" . "%0A" .
        "⬇Скачиваний за 24 часа: " . DB::getCountDowloads(1) ."%0A".
        "⬇Скачиваний за 7 дней: " . DB::getCountDowloads(7) ."%0A".
        "⬇Скачиваний за 30 дней: " . DB::getCountDowloads(30) ."%0A".
        "За всё время: " . DB::getCountDowloads('all') ."%0A" ;
    } else {
        $message =
        "Мамонт скачал: $name" . "%0A" .
        "Ошибка подключения или выполнения запроса";
    }
    foreach ($users as $user){
        @file_get_contents('https://api.telegram.org/bot' . TOKEN . '/sendMessage?chat_id=' . $user . '&parse_mode=html&text=' . $message);

    }

?>