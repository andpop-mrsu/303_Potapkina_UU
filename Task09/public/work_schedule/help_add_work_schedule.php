<?php
$pdo = new PDO('sqlite:../../data/service_station.db');

$worker_id = $_POST['worker_id'];

$query = "insert into 'busyness'('data','work_hours_start','work_hours_end', 'is_actual')" .
    " values ('" . $_POST['date_busyness'] . "', '" . $_POST['busyness_time_start'] . "', '" .
    $_POST['busyness_time_end'] . "', " . "'да" . "');";
$statement = $pdo->query($query);
$last_row_id_busyness = $pdo->lastInsertID();
$query = "insert into 'workers_busyness'('worker_id','busyness_id')" .
    " values (" . $_POST['worker_id'] . ", " . $last_row_id_busyness . ");";
$statement = $pdo->query($query);
?>


<!DOCTYPE html>
<html lang="ru">
<body style="font-size: 20px; padding: 0 5%">
<div>
    <h1>Запись графика работы мастера успешно добавлена</h1>

    <form method="post" enctype="application/x-www-form-urlencoded"
          action="work_schedule.php?worker_id=<?= $worker_id ?>">
        <button style="font-size: 16px">Вернуться к рабочему графику</button>
    </form>
</div>
</body>
</html>