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

$id_worker = $_POST['id_worker'];
$worker = $event->getWorkerForID($id_worker);

$id_car_category = $_POST['id_car_category'];
$car_category = $event->getCarCategoriesId($id_car_category);

$id_service_car_category = $event->getIdSCC($id_service, $id_car_category);

$time_work = $event->getByusyness($id_worker);

$time = null;
$price = null;
foreach ($id_service_car_category as $item):
    $time = $item['duration_in_hours'];
    $price = $item['price'];
endforeach;
?>

<form method="post" enctype="application/x-www-form-urlencoded" action="add_orders_fourth.php">
    <legend style="font-size:24px">Услуга:
        <input type="hidden" name="id_service" value="<?= $id_service ?>">
        <?php foreach ($name_of_service as $name_s): ?>
            <?= $name_s['name_of_service']; ?>
        <?php endforeach; ?>
        <?php print(", время выполнения в часах: ". $time . ", стоимось в рублях: " . $price); ?>
    </legend>

    <legend style="font-size:24px">Категория транспорта:
        <input type="hidden" name="id_car_category" value="<?= $id_car_category ?>">
        <?php foreach ($car_category as $name_s): ?>
            <?= $name_s['description']; ?>
        <?php endforeach; ?>
    </legend>

    <legend style="font-size:24px">Мастер:
        <input type="hidden" name="id_worker" value="<?= $id_worker ?>">
        <?php foreach ($worker as $item): ?>
            <?= $item['last_name'] . " " . $item['first_name'] . " " . $item['patronymic'] ?>
        <?php endforeach; ?>
    </legend>
    <hr>
    <?php foreach ($id_service_car_category as $item): ?>
        <input type="hidden" name="id_service_car_category" value="<?= $item['id'] ?>">
    <?php endforeach; ?>

    <legend style="font-size:24px">Рабочие дни:
        <br>
        <?php foreach ($time_work as $item): ?>
            <?= $item['data'] . ": " . $item['work_hours_start'] . " - " . $item['work_hours_end'] ?><br>
            Занятость:<br>
            <?php foreach ($event->getByusynessData($id_worker, $item['data']) as $item2): ?>
                &nbsp;&nbsp;&nbsp;<?= $item2['service_execution_time'] ?><br>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </legend>

    <fieldset>
        <p><label>Выберите дату: <input type="date" name="date_order"></label></p>
        <p><label>Выберите время начала согласно расписанию мастера: <input type="time" name="time_order"></label></p>
        <p><label>Введите Ваш номер телефона в формате "+7...": <input type="tel" name="phone_number"></label><p>
        <p><label>Введите марку Вашей машины: <input name="car_brand"></label><p>
        <p><label>Введите модель Вашей машины: <input name="car_model"></label><p>
    </fieldset>

    <button type="submit">Отправить данные</button>
</form>
</body>
</html>