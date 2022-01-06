<html>
<head>
    <meta charset="UTF-8">
    <title>Предварительная запись</title>
</head>

<body>
<?php
require_once '../Events.php';
$event = new Events('../../data/service_station.db');
$id_service = $_POST['id_service'];
$name_of_service = $event->getNameService($id_service);
$workers_for_IDS = $event->getWorkersForIDS($id_service);
$workers = array();
foreach ($workers_for_IDS as $worker):
    foreach ($event->getWorkerForID($worker['worker_id']) as $item):
        array_push($workers, $item);
    endforeach;
endforeach;
$car_categories = $event->getCarCategories($id_service);
?>

<form method="post" enctype="application/x-www-form-urlencoded" action="add_order_third.php">
    <legend style="font-size:24px">Услуга:
        <input type="hidden" name="id_service" value="<?= $id_service ?>">
        <?php foreach ($name_of_service as $name_s): ?>
                <?= $name_s['name_of_service']; ?>
        <?php endforeach; ?>
    </legend>
    <hr>

    <legend style="font-size:20px">Выбрать категорию машины</legend>
    <br>
    <select style="width: 200px;" name="id_car_category">
        <?php foreach ($car_categories as $item): ?>
            <option value=<?= $item['id'] ?>>
                <?= $item['id'] . ". " . $item['description'] ?>
            </option>
        <?php endforeach; ?>
    </select>

    <h4></h4>
    <legend style="font-size:20px">Выбрать мастера</legend>
    <select style="width: 200px;" name="id_worker">
        <?php foreach ($workers as $worker): ?>
            <option value=<?= $worker['id'] ?>>
                <?= $worker['id'] . ". " . $worker['last_name'] . " " . $worker['first_name'] . " " . $worker['patronymic'] ?>
            </option>
        <?php endforeach; ?>
    </select>

    <h4></h4>
    <button type="submit">Выбор времени для записи и ввод личных данных</button>
</form>
</body>
</html>