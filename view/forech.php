<div class="list-group list-group-flush">
    <?php
    $todo = new TODO();
    $malumotlar = $todo->GETTODO();
    foreach ($malumotlar as $item) {
        $checked = $item['status'] ? 'checked' : '';
        $strike = $item['status'] ? 'text-decoration-line-through' : '';
        $action  = $item['status'] ? 'uncompleted' : 'complete';
        echo "<div class='d-flex list-group-item'>";
        echo "    <a href='?$action={$item['id']}' class='w-100 text-decoration-none text-dark'>";
        echo "          {$item['id']}";
        echo "        <input class='form-check-input me-1' type='checkbox' id='task-{$item['id']}' $checked>";
        echo "        <label class='form-check-label $strike' for='task-{$item['id']}'>{$item['text']}</label>";
        echo "    </a>";
        echo "    <a href='?id={$item['id']}' type='button' class='p-2'><i class='fa-solid fa-trash text-danger'></i></a>";
        echo "</div>";
    } ?>
</div>
