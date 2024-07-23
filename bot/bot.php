<?php

declare(strict_types=1);
require "src/Bot.php";
$bot = new Bot();

if (isset($update->message)) {
    $message = $update->message;
    $chatId  = $message->chat->id;
    $text    = $message->text;

    if ($text === "/start") {
        $bot->handleStartCommand($chatId);
        return;
    }

    if ($text === "/add") {
        $bot->handleAddCommand($chatId);
        return;
    }

    if ($text === "/all") {
        $bot->getAllTasks($chatId);
        return;
    }

    $bot->addTask($chatId, $text);
}

if (isset($update->callback_query)) {
    $callbackQuery = $update->callback_query;
    $callbackData  = $callbackQuery->data;
    $chatId        = $callbackQuery->message->chat->id;
    $messageId     = $callbackQuery->message->message_id;
    $user = new \src\User();
    if ($callbackData == 'delete_task') {
        $bot->handleDeleteCommand($chatId);
        return;
    }
    if ($user->getUserInfo($chatId)->status == 'delete') {
        $bot->handleDeleteTask($chatId, (int)$callbackData);
        $user->setStatus($chatId, '');
        return;
    }
    $bot->handleInlineButton($chatId, (int)$callbackData);
}
