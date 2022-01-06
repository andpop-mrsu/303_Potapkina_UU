<?php
$pdo = new PDO('sqlite:../../data/service_station.db');

$query = "insert into 'workers'('last_name', 'first_name', 'patronymic', 'date_of_birth', 'specialization_id', 'percentage_of_revenue', 'status') values (" .
    "'" . $_POST['surname'] . "','" . $_POST['name'] . "','" . $_POST['patronymic'] . "','" . $_POST['date_of_birth'] .
    "','" . $_POST['specialization'] . "'," . $_POST['percentage_of_revenue'] . ",'" . $_POST['status'] . "');";
$statement = $pdo->query($query);

$last_row_id_w = $pdo->lastInsertID();
$name_service = $_POST['name_of_service'];
foreach ($name_service as $item):
    $query = "insert into 'workers_services'('worker_id','service_id') VALUES (" . $last_row_id_w . ", $item);";
    $statement = $pdo->query($query);
endforeach;
?>


<!DOCTYPE html>
<html lang="en">
<body>
<form method="post" enctype="application/x-www-form-urlencoded" action="add_worker.php">
    <p>
        <button>Вернуться к вводу информации о сотрудниках</button>
    </p>
</form>

<form method="post" enctype="application/x-www-form-urlencoded" action="../index.php">
    <p>
        <button>Вернуться к выбору формы для ввода</button>
    </p>
</form>
</body>
</html>