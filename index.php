<?php
require "DB.php";
require "Todo.php";
$pdo = DB::connect();

$todo = new TODO($pdo);



if (!empty($_POST)) {
    if (isset($_POST['text'])) {
        $todo->SETTODO($_POST['text']);
        header('Location:  index.php');
    }
}

if (!empty($_GET)) {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        echo $_GET['delet'];
        $todo -> DELETTODO($id);
    }
}

if (!empty($_POST)) {
    if (isset($_POST['update'])) {
        $ID = $_POST['ID'];
        $update = $_POST['update'];
        $todo -> UPDATETODO($ID,$update);

    }
}



require "view.php";
