<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Выполненые работы мастером</title>
</head>
<body style="font-size: 20px">
<?php
require_once 'Events.php';
$event = new Events('../data/service_station.db');

$worker_id = $_GET['worker_id'];
$worker = $event->getWorkerById($worker_id);

$orders = $event->getWorkPerformedByWorker($worker_id);

?>

<div style="padding: 0 5%">
    <h1 align="center">Выполненые работы</h1>
    <h2>Мастер: <?php print($worker['last_name'] . " " . $worker['first_name'] . " " . $worker['patronymic']); ?></h2>
    <hr>

    <table class="workers-table" cellpadding="7" cellspacing="0" border="1" width="100%">
        <tr class="table-header">
            <th>Название услуги</th>
            <th>Дата</th>
            <th>Время начала ремонта</th>
            <th>Время окончания ремонта</th>
            <th>Цена услуги (в рублях)</th>
        </tr>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td><?= $order['name_of_service'] ?></td>
                <td><?= substr($order['service_execution_time'], 0, 10) ?></td>
                <td><?= substr($order['service_execution_time'], 11, 5) ?></td>
                <td><?= substr($order['service_execution_time'], 17, 5) ?></td>
                <td><?= $order['price'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <h2></h2>

    <form method="post" enctype="application/x-www-form-urlencoded" action="index.php">
        <button style="font-size: 16px">Вернуться на главный экран</button>
    </form>
</div>
</body>
</html>