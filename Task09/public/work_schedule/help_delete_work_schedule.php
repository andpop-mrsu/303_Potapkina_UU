<?php
$pdo = new PDO('sqlite:../../data/service_station.db');

$wb_id = $_POST['wb_id'];

$query = "select * from workers_busyness where id =". $wb_id .";";
$statement = $pdo->query($query);
$rows = $statement->fetchAll();
$statement->closeCursor();
$rows = $rows[0];

$query = "UPDATE 'busyness' SET is_actual='нет' WHERE busyness.id=". $rows['busyness_id'] .";";
$statement = $pdo->prepare($query);
$statement->execute();

?>


<!DOCTYPE html>
<html lang="ru">
<body style="font-size: 20px; padding: 0 5%">
<div>
    <h1>Запись из графика работы мастера успешно удалена</h1>

    <form method="post" enctype="application/x-www-form-urlencoded" action="work_schedule.php?worker_id=<?= $rows['worker_id'] ?>">
        <button style="font-size: 16px">Вернуться к рабочему графику</button>
    </form>
</div>
</body>
</html>