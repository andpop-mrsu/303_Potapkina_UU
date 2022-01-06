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

$worker_id = $_GET['worker_id'];
$worker = $event->getWorkerById($worker_id);
?>
<form method="post" enctype="application/x-www-form-urlencoded" action="help_delete_worker.php">
    <input type="hidden" name="worker_id" value=<?= $worker_id ?>>

    <legend>Вы действительно хотите удалить данную запись в графике работы мастера?</legend>
    <br>
    <button style="font-size: 16px">Удалить запись</button>
    <br><br>

</form>

<form method="post" enctype="application/x-www-form-urlencoded" action="../index.php">
    <button style="font-size: 16px">Вернуться на главный экран</button>
</form>


</body>
</html>
