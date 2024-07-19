<?php
require "DB.php";
require "Todo.php";
$pdo = DB::connect();

$todo = new TODO($pdo);



if (!empty($_POST) || !empty($_GET)) {
    if (isset($_POST['text'])) {
        $todo->SETTODO($_POST['text']);
        header('Location:  index.php');
    }
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        echo $_GET['delet'];
        $todo->DELETTODO($id);
    }
    if (isset($_GET['complete'])) {
        $task->complete($_GET['complete']);
    }
    if (isset($_GET['uncompleted'])) {
        $task->uncompleted($_GET['uncompleted']);
    }
}




require "view.php";
