<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Добавлениие мастера</title>
</head>
<body >
<?php
require_once '../Events.php';
$event = new Events('../../data/service_station.db');
?>

<form method="post" action="help_add_worker.php" enctype="application/x-www-form-urlencoded">
    <H1>Добавление мастера</H1>
    <fieldset>
        <legend> Личная информация о мастере</legend>
        <p><label>Фамилия: <input name="surname"></label></p>
        <p><label>Имя: <input name="name"></label></p>
        <p><label>Отчество: <input name="patronymic"></label></p>
        <p><label>Дата рождения: <input type="date" name="date_of_birth"></label></p>
    </fieldset>

    <H4> Рабочая информация о мастере </H4>
    <fieldset>
        <legend> Специализация </legend>
        <?php foreach ($event->getSpecialization() as $item): ?>
            <p><label> <input type="radio" name="specialization" value="<?= $item['id'] ?>"> <?= $item['title'] ?> </label></p>
        <?php endforeach; ?>
    </fieldset>

    <h4></h4>
    <fieldset>
        <legend> Работы, которые может выполнять мастер </legend>
        <?php foreach ($event->getWorkPerformed() as $item): ?>
            <p><label> <input type="checkbox" name="name_of_service[]" value="<?= $item['id'] ?>"> <?= $item['name_of_service'] ?> </label></p>
        <?php endforeach; ?>
    </fieldset>

    <p><label>Процент выручки: <input type="number" min="1" max="100" name="percentage_of_revenue" value="50"></label></p>
    <fieldset>
        <legend> Статус </legend>
        <p><label> <input type="radio" name="status" value="является работником"> Является работником </label></p>
        <p><label> <input type="radio" name="status" value="не является работником"> Не является работником </label></p>
    </fieldset>
    </fieldset>

    <p><button>Отправить данные</button></p>
</form>
</body>
</html>
