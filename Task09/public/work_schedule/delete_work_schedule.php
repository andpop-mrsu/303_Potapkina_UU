<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Удаление записи в расписании мастера</title>
</head>


<body style="font-size: 20px; padding: 0 5%">
<?php
require_once '../Events.php';
$event = new Events('../../data/service_station.db');

$wb_id = $_GET['wb_id'];
$wb = $event->getWorkersBusynessById($wb_id);
$worker = $event->getWorkerById($wb['worker_id']);
?>
<form method="post" enctype="application/x-www-form-urlencoded" action="help_delete_work_schedule.php">
    <input type="hidden" name="wb_id" value=<?= $wb_id ?>>

    <legend>Вы действительно хотите удалить данную запись в графике работы мастера?</legend>
    <br>
    <button style="font-size: 16px">Удалить запись</button>
    <br><br>

</form>

<form method="post" enctype="application/x-www-form-urlencoded" action="work_schedule.php?worker_id=<?= $worker['id'] ?>">
    <button style="font-size: 16px">Вернуться к графику работы мастера</button>
    <br><br>
</form>


</body>
</html>
