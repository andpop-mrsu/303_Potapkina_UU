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

$wb_id = $_GET['wb_id'];
$wb = $event->getWorkersBusynessById($wb_id);

$busyness = $event->getBusynessById($wb['busyness_id']);
?>
<form method="post" enctype="application/x-www-form-urlencoded" action="help_update_work_schedule.php">


    <input type="hidden" name="busyness_id" value=<?= $wb['busyness_id'] ?>>
    <input type="hidden" name="worker_id" value=<?= $wb['worker_id'] ?>>

    <fieldset>
        <legend>Изменение графика работы мастера на <?= $busyness['data'] ?> </legend>
        <p><label>Время начала рабочего дня: <input type="time"
                                                    name="busyness_time_start"
                                                    value="<?= $busyness['work_hours_start'] ?>"></label></p>
        <p><label>Время окончания рабочего дня: <input type="time"
                                                       name="busyness_time_end"
                                                       value="<?= $busyness['work_hours_end'] ?>"></label></p>

    </fieldset>

    <p>
        <button style="font-size: 16px">Отправить данные</button>
    </p>
</form>

<form method="post" enctype="application/x-www-form-urlencoded"
      action="work_schedule.php?worker_id=<?= $wb['worker_id'] ?>">
    <button style="font-size: 16px">Вернуться к рабочему графику</button>
</body>
</html>
