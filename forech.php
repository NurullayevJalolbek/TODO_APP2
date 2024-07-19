<?php
$malumotlar = $todo->GETTODO();
?>
<div class="list-group list-group-flush">
    <?php
    foreach ($malumotlar as $item) {
        $checked = $item['status'] ? 'checked' : '';
        $strike = $item['status'] ? 'text-decoration-line-through' : '';
        $action  = $task['status'] ? 'uncompleted' : 'complete';
        echo "<div class='d-flex list-group-item'>";
        echo "<tr>";
        echo "    <td>{$item['id']}</td>";
        echo "    <td><input class='form-check-input me-1' type='checkbox' id='task-{$task['id']}' $checked></td>";
        echo "    <td><label class='form-check-label $strike' for='task-{$item['id']}'>{$item['text']}</label></td>";
        echo "    <td><a href='?$action={$task['id']}' class='w-100 text-decoration-none text-dark'></td>";
        echo "    <td><a href='index.php?id={$item['id']}' class='p-2'><i class='fa-solid fa-trash text-danger'></i></a></td>";
        echo "</tr>";
        echo "</div>";
    } ?>
</div>

