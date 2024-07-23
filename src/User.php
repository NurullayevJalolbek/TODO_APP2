<?php

namespace src;

use DB;

class User
{
    private $pdo;

    public function __construct()
    {
        $this->pdo  = DB::connect();
    }
    public function  setStatus(int $chatId, $commands = 'add')
    {
        $query  = "INSERT INTO USERID (chat_id, commands)
                  VALUES (:chat_id, :commands)
                  ON DUPLICATE KEY UPDATE commands = :commands";
        $stmt   = $this->pdo->prepare($query);
        $stmt->bindParam(':chat_id', $chatId);
        $stmt->bindParam(':commands', $commands);
        $stmt->execute();
    }

    public function getUserInfo(int $chatId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM USERID where chat_id = :chat_id LIMIT 1");
        $stmt->execute(['chat_id' => $chatId]);
        return $stmt->fetchObject();
    }
}
