<?php
require "src/BOT.php";
$bot = new Bot();
require "src/USERS.php";
$users = new USERS();
if (isset($update->message)) {
    $message = $update->message;
    $chatId = $message->chat->id;
    $text = $message->text;

    if ($text === '/start') {
        $bot->STARTBOT($chatId);
        return;
    }

    if ($text === "/add") {
        $bot->ADDBOT($chatId);
    }
    if ($text != "") {
        $status = false;
        $users->SaveUsers($chatId, $text, $status);
    }
    if ($text === "/oqish") {
        $malumotlar = $users->RedUser($chatId);
        $bot->OQISH(strval($chatId), $malumotlar);
    }
}
