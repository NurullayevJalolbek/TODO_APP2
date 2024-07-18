<?php

class TODO
{
    private $pdo;
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
    public function SETTODO(string $todoname)
    {
        $status = false;

        $stmt = $this->pdo->prepare('INSERT INTO todo_app (text, status) VALUES(:text, :status)');

        $todoname = trim($todoname);
        $stmt->bindParam("text", $todoname);
        $stmt->bindParam("status", $status, PDO::PARAM_BOOL);
        $stmt->execute();
    }
    public function GETTODO()
    {
        return $this->pdo->query("SELECT * FROM todo_app")->fetchAll(PDO::FETCH_ASSOC);
    }
    public function DELETTODO($ID)
    {
        $this->pdo->query("DELETE FROM todo_app WHERE id = $ID");
        //$this->GETTODO();
    }
    public function UPDATETODO($id, $text)
    {
        $stmt = $this->pdo->prepare("UPDATE  todo_app SET text = :text WHERE id = :id");
        $stmt->bindParam(':text', $text);
        $stmt->bindParam(':id', $id);
        $stmt -> execute();
        //$this->GETTODO();
    }
}
