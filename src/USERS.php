<?php
require "src/DB.php";

class USERS
{
    private $pdo;
    public function __construct()
    {
        $this->pdo = DB::connect();
    }
    public function SaveUsers(string $chat_id, string $text, $status)
    {
        $stmt = $this->pdo->prepare("INSERT INTO  USERS (chat_id, text, status) VALUES (:chat_id,:text,:status)");
        $stmt->bindParam(':chat_id', $chat_id);
        $stmt->bindParam(':text', $text);
        $stmt->bindParam(':status', $status, PDO::PARAM_BOOL);
        $stmt->execute();
    }
    public function RedUser($chat_id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM USERS WHERE chat_id = :chat_id");
        $stmt->bindParam(':chat_id', $chat_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
