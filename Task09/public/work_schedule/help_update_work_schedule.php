<?php
$pdo = new PDO('sqlite:../../data/service_station.db');

$busyness_id = $_POST['busyness_id'];
$worker_id = $_POST['worker_id'];

$query = "UPDATE 'busyness' SET work_hours_start = '" . $_POST['busyness_time_start'] .
    "' WHERE busyness.id=" . $busyness_id . ";";
$statement = $pdo->prepare($query);
$statement->execute();


$query = "UPDATE 'busyness' SET work_hours_end = '" . $_POST['busyness_time_end'] .
    "' WHERE busyness.id=" . $busyness_id . ";";
$statement = $pdo->prepare($query);
$statement->execute();
?>


<!DOCTYPE html>
<html lang="ru">
<body style="font-size: 20px; padding: 0 5%">
<div>
    <h1>Запись графика работы мастера успешно обновлена</h1>

    <form method="post" enctype="application/x-www-form-urlencoded"
          action="work_schedule.php?worker_id=<?= $worker_id ?>">
        <button style="font-size: 16px">Вернуться к рабочему графику</button>
    </form>
</div>
</body>
</html>