<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>График работы мастера</title>
</head>
<body style="font-size: 20px">
<?php
require_once '../Events.php';
$event = new Events('../../data/service_station.db');

$worker_id = $_GET['worker_id'];
$worker = $event->getWorkerById($worker_id);

$times_work = $event->getWorkersBusynessByWorkerId($worker_id);
?>

<div style="padding: 0 5%">
    <h1 align="center">График работы</h1>
    <h2>Мастер: <?php print($worker['last_name'] . " " . $worker['first_name'] . " " . $worker['patronymic']); ?></h2>
    <hr>

    <table class="workers-table" cellpadding="7" cellspacing="0" border="1" width="100%">
        <tr class="table-header">
            <th>Дата</th>
            <th>Время начала</th>
            <th>Время окончания</th>
            <th>Ссылка на редактирование</th>
            <th>Ссылка на удаление</th>
        </tr>
        <?php foreach ($times_work as $time_work): ?>
            <tr>
                <td><?= $time_work['data'] ?></td>
                <td><?= $time_work['work_hours_start'] ?></td>
                <td><?= $time_work['work_hours_end'] ?></td>
                <td>
                    <a href="update_work_schedule.php?wb_id=<?= $time_work['id'] ?>">Обновить</a>
                </td>
                <td>
                    <a href="delete_work_schedule.php?wb_id=<?= $time_work['id'] ?>">Удалить</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <h2></h2>

    <form method="post" enctype="application/x-www-form-urlencoded"
          action="add_work_schedule.php?worker_id=<?= $worker_id ?>">
        <button style="font-size: 16px">Добавить запись в рабочий график</button>
    </form>
    <h2></h2>

    <form method="post" enctype="application/x-www-form-urlencoded" action="../index.php">
        <button style="font-size: 16px">Вернуться на главный экран</button>
    </form>
</div>
</body>
</html>