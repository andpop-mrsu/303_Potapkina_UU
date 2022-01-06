<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Список мастеров СТО №1</title>
</head>
<body style="font-size: 20px;">
<?php
require_once 'Events.php';
$event = new Events('../data/service_station.db');

$workers = $event->getWorkers();
?>

<h1 align="center">Список мастеров СТО</h1>

<div style="padding: 0 5%">
    <table class="workers-table" cellpadding="7" cellspacing="0" border="1" width="100%">
        <tr class="table-header">
            <th>Фамилия</th>
            <th>Имя</th>
            <th>Отчество</th>
            <th>Специализация</th>
            <th>Ссылка на редактирование</th>
            <th>Ссылка на удаление</th>
            <th>График</th>
            <th>Выполненные работы</th>
        </tr>
        <?php foreach ($workers as $worker): ?>
            <tr>
                <td><?= $worker['last_name'] ?></td>
                <td><?= $worker['first_name'] ?></td>
                <td><?= $worker['patronymic'] ?></td>
                <td><?= $event->getSpecializationById($worker['specialization_id']) ?></td>
                <td>
                    <a href="edit_worker/edit_worker.php?worker_id=<?= $worker['id'] ?>">Редактировать</a>
                </td>
                <td>
                    <a href="delete_worker/delete_worker.php?worker_id=<?= $worker['id'] ?>">Удалить</a>
                </td>
                <td>
                    <a href="work_schedule/work_schedule.php?worker_id=<?= $worker['id'] ?>">График</a>
                </td>
                <td>
                    <a href="completed_work.php?worker_id=<?= $worker['id'] ?>">Выполненные работы</a>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>

    <H2></H2>
    <form method="post" enctype="application/x-www-form-urlencoded" action="add_worker/add_worker.php">

        <button style="font-size: 16px">Добавить нового рабочего</button>

    </form>
</div>
</body>
</html>
