<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Станция технического обслуживания</title>
</head>
<body>

<?php
$pdo = new PDO('sqlite:service_station.db');

$queryStart = "select id, last_name, first_name, patronymic " . "from workers";
$statement = $pdo->query($queryStart);
$rows = $statement->fetchAll();
$workers = $rows;
$statement->closeCursor();
?>

<h1>Выбрать Id мастера</h1>
<form action="" method="POST">
    <label>
        <select style="width: 200px;" name="id">
            <option value=<?= null ?>>
                All
            </option>
            <?php foreach ($workers as $row) { ?>
                <option value= <?= $row['id'] ?>>
                    <?= $row['id'] ?>
                </option>
            <?php } ?>
        </select>
    </label>
    <button type="submit">Поиск по Id</button>
</form>

<?php
$id = 0;
if(isset($_POST['id'])){
    $id = (int)$_POST['id'];
}

$services = null;

if ($id == 0) {
    $query =
        "select workers.id, last_name, first_name, patronymic, orders.service_execution_time, services.name_of_service, services_car_categories.price " .
        "from workers, orders, services, services_car_categories,orders_services_car_categories " .
        "where (orders_services_car_categories.services_car_categories_id=services_car_categories.id and orders.worker_id = workers.id and orders_services_car_categories.orders_id=orders.id and services_car_categories.service_id = services.id) " .
        "order by workers.last_name, orders.service_execution_time";
} else {
    $query =
        "select workers.id, last_name, first_name, patronymic, orders.service_execution_time, services.name_of_service, services_car_categories.price " .
        "from workers, orders, services, services_car_categories,orders_services_car_categories " .
        "where (orders_services_car_categories.services_car_categories_id=services_car_categories.id and orders.worker_id = workers.id and orders_services_car_categories.orders_id=orders.id and services_car_categories.service_id = services.id and workers.id = {$id}) " .
        "order by workers.last_name, orders.service_execution_time";
}
$statement = $pdo->query($query);
$services = $statement->fetchAll();
?>
<H1></H1>
<table class="workers-table" cellpadding="7" cellspacing="0" border="1" width="100%">
    <tr class="table-header">
        <th>Id</th>
        <th>Фамилия</th>
        <th>Имя</th>
        <th>Отчество</th>
        <th>Время выполнения заявки</th>
        <th>Название услуги</th>
        <th>Цена</th>
    </tr>
    <?php foreach ($services as $service): ?>
        <tr>
            <td><?= $service['id'] ?></td>
            <td><?= $service['last_name'] ?></td>
            <td><?= $service['first_name'] ?></td>
            <td><?= $service['patronymic'] ?></td>
            <td><?= $service['service_execution_time'] ?></td>
            <td><?= $service['name_of_service'] ?></td>
            <td><?= $service['price'] . "руб." ?></td>
        </tr>
    <?php endforeach; ?>

</table>
</body>
</html>