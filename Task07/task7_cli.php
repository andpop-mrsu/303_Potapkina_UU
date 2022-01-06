<?php

$pdo = new PDO('sqlite:service_station.db');

$queryStart = "select id, last_name, first_name, patronymic " . "from workers";
$statement = $pdo->query($queryStart);
$rows = $statement->fetchAll();

echo "Мастера, находящиеся в базе:\n";
foreach ($rows as $row) {
    echo $row['id'] . ' ' . $row['last_name'] . ' ' . $row['first_name'] . ' ' . $row['patronymic'] . "\n";
}
$workers = $rows;
$statement->closeCursor();

echo "-------------------------------------\n";

$number = readline("Введите номер мастера: ");

if ($number == "") {
    $query =
        "select workers.id, last_name, first_name, patronymic, orders.service_execution_time, services.name_of_service, services_car_categories.price " .
        "from workers, orders, services, services_car_categories,orders_services_car_categories " .
        "where (orders_services_car_categories.services_car_categories_id=services_car_categories.id and orders.worker_id = workers.id and orders_services_car_categories.orders_id=orders.id and services_car_categories.service_id = services.id) " .
        "order by workers.last_name, orders.service_execution_time";
    $statement = $pdo->query($query);
    $rows = $statement->fetchAll();

    //$format = '%3.3s %-20.20s %-20.20s %-20.20s %-20.20s %-20.20s %-20.20s' . "\n";
    foreach ($rows as $row) {
        echo $row['id'] . ' ' . $row['last_name'] . ' ' . $row['first_name'] . ' ' . $row['patronymic'] . ' ' . $row['service_execution_time'] . ' ' . $row['name_of_service'] . ' ' . $row['price'] . "\n";
        //printf($format, $row['id'], $row['last_name'], $row['first_name'], $row['patronymic'], $row['service_execution_time'], $row['name_of_service'], $row['price']);
    }
    exit(0);
}

$checkNumber = 0;
foreach ($workers as $row) {
    if ($row['id'] == $number) {
        $checkNumber = 1;
    }
}
if ($checkNumber == 0) echo "Введен некоректный номер мастера\n";
else {
    $query =
        "select workers.id, last_name, first_name, patronymic, orders.service_execution_time, services.name_of_service, services_car_categories.price " .
        "from workers, orders, services, services_car_categories,orders_services_car_categories " .
        "where (orders_services_car_categories.services_car_categories_id=services_car_categories.id and orders.worker_id = workers.id and orders_services_car_categories.orders_id=orders.id and services_car_categories.service_id = services.id and workers.id = {$number}) " .
        "order by workers.last_name, orders.service_execution_time";
    $statement = $pdo->query($query);
    $rows = $statement->fetchAll();

    if (count($rows) != 0) {
        foreach ($rows as $row) {
            echo $row['id'] . ' ' . $row['last_name'] . ' ' . $row['first_name'] . ' ' . $row['patronymic'] . ' ' . $row['service_execution_time'] . ' ' . $row['name_of_service'] . ' ' . $row['price'] . "\n";
        }
    } else {
        echo 'У мастера с номером ' . $number . ' пока нет выполненных заявок.' . "\n";
    }

}
?>