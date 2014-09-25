<table class="todo_list">
    <tr>
        <td class="task_status">Статус</td>
        <td class="task_text" align="center">Завдання</td>
    </tr>
    <?php
    foreach ($todoList as $task):
        if (!$task['status']) {
            $check = '';
            $completedTask = '';
        } elseif ($task['status']) {
            $check = 'checked';
            $completedTask = 'class="completed_task"';
        } ?>
        <tr>
            <td class="task_status">
                <form action="index.php" method=POST>
                    <input type="checkbox" onClick="this.form.submit()" <?= $check ?> name="check" value="<?= $task['id'] ?>" />
                    <input type="hidden" name="check" value="<?= $task['id'] ?>" />
                    <input  type="hidden" name="action" value="changeStatus" />
                </form>  
            </td>
            <td class="task_text"><span <?= $completedTask ?>><?= $task['task'] ?></span></td>
        </tr>
    <? endforeach; ?>
</table>
<a href="index.php?action=addTask">Додати завдання</a>
