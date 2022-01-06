<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Обновление данных о графике работы мастера</title>
</head>

<body style="font-size: 20px; padding: 0 5%">
<?php
require_once '../Events.php';
$event = new Events('../../data/service_station.db');

$worker_id = $_GET['worker_id'];
?>
<form method="post" enctype="application/x-www-form-urlencoded" action="help_add_work_schedule.php">

    <input type="hidden" name="worker_id" value=<?= $worker_id ?>>
    <fieldset>
        <legend> Ввод новых данных о графике работы мастера</legend>
        <p><label>Дата: <input type="date" name="date_busyness"></label></p>
        <p><label>Время начала рабочего дня: <input type="time"
                                                    name="busyness_time_start"></label></p>
        <p><label>Время окончания рабочего дня: <input type="time"
                                                       name="busyness_time_end"></label></p>

    </fieldset>

    <button style="font-size: 16px">Отправить данные</button>
    <br><br>
</form>

<form method="post" enctype="application/x-www-form-urlencoded"
      action="work_schedule.php?worker_id=<?= $worker_id ?>">
    <button style="font-size: 16px">Вернуться к рабочему графику</button>
</form>
</body>
</html>
