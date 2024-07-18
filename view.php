<!DOCTYPE html>
<html lang="en">

<head>

    <title>TODO-LIST</TODO-LIST></title>
</head>

<body>
    <form action="index.php" method="post">
        <input type="text" name="text">
        <button type="submit"> Yuboriish</button>
    </form>

</body>

</html>
<ul>
    <?php
    $malumotlar = $todo->GETTODO();
    foreach ($malumotlar as $item) :
        $IDDD = $item['id'];
        echo "<li><input type=\"checkbox\" value=\"{$item['id']}\"> {$item['text']} <a href=\"index.php?id={$item['id']}\">O'chirish</a>"; ?>
        <form action="index.php" method="post">
            <input type="text" name="update">
            <input type="hidden" name="ID" value="<?= $item['id'] ?>">
            <button type="submit">Update</button>
        </form>
    <?php endforeach;
    ?>
</ul>