<?php

use GuzzleHttp\Client;

require 'vendor/autoload.php';
class Bot
{
    const  string TOKEN = "7279583274:AAFi8wAbq7WtquAV-ECXTdi6j7kMwC5XXts";
    const API   = "https://api.telegram.org/bot";

    public Client $client;


    public function __construct()
    {
        $this->client = new Client(['base_uri' => self::API . self::TOKEN . "/"]);
    }

    public function STARTBOT($chatId)
    {
        $this->client->post('sendMessage', [
            'form_params' => [
                'chat_id' => $chatId,
                'text' => "------------Assalomu alaykum --------\nmalumot qo'shmoqchi bo'lsangiz /add komandasini kiriting"
            ]
        ]);
    }
    public function ADDBOT($chatId)
    {
        $this->client->post('sendMessage', [
            'form_params' => [
                'chat_id' => $chatId,
                'text' => "Kiritmoqchi bo'gan malumotingizni kiriting"
            ]
        ]);
    }
    public function OQISH($chatId, $malumot)
    {
        $hammasi = "";
        foreach ($malumot as $item) {
            $message = "Chat ID: {$item['chat_id']}\nText: {$item['text']}\nStatus: {$item['status']}";
            $hammasi .= $message;
        }
        $this->client->post('sendMessage', [
            'form_params' => [
                'chat_id' => $chatId,
                'text' => $hammasi
            ]
        ]);
    }
}

