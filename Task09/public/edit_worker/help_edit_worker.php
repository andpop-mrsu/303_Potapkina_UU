<?php
$pdo = new PDO('sqlite:../../data/service_station.db');

$query = "update 'workers' set 'last_name'=" . "'" . $_POST['surname'] . "'" .
    ", 'first_name'=" . "'" . $_POST['name'] . "'" . ", 'patronymic'=" . "'" . $_POST['patronymic'] . "'" .
    ", 'specialization_id'=" . "'" . $_POST['specialization_id'] . "'" .
    ", 'percentage_of_revenue'=" . $_POST['percentage_of_revenue'] .
    " where id=" . $_POST['worker_id'] . "; ";
$statement = $pdo->prepare($query);
$statement->execute();

$query = "update 'workers_services' set 'is_action'= 'нет' where worker_id = " . $_POST['worker_id'] . ";";
$statement = $pdo->prepare($query);
$statement->execute();

$name_service = $_POST['name_of_service'];
foreach ($name_service as $item):
    $query = "select * from workers_services where worker_id = " . $_POST['worker_id'] .
        " and service_id = ". $item .";";
    $statement = $pdo->query($query);
    $rows = $statement->fetchAll();
    $statement->closeCursor();
    if (count($rows) > 0) {
        $query = "update 'workers_services' set 'is_action'= 'да' where worker_id = " . $_POST['worker_id'] .
            " and service_id = " . $item . ";";
        $statement = $pdo->prepare($query);
        $statement->execute();
    } else {
        $query = "insert into 'workers_services'('worker_id','service_id') VALUES (" . $_POST['worker_id'] . ", $item);";
        $statement = $pdo->query($query);
    }
endforeach;
?>


<!DOCTYPE html>
<html lang="ru">
<body style="font-size: 20px; padding: 0 5%">
<div>
    <h1>Информация о мастере успешна изменена</h1>

    <form method="post" enctype="application/x-www-form-urlencoded" action="../index.php">
        <button style="font-size: 16px">Вернуться на главный экран</button>
    </form>
</div>
</body>
</html>