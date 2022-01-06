<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавлениие мастера</title>
</head>
<body style="font-size: 20px">
<?php
require_once '../Events.php';
$event = new Events('../../data/service_station.db');

$worker_id = $_GET['worker_id'];

$worker = $event->getWorkerById($worker_id);
?>
<div style="padding: 0 5%">
    <form method="post" action="help_edit_worker.php" enctype="application/x-www-form-urlencoded">
        <H1>Добавление мастера</H1>
        <fieldset>
            <legend> Личная информация о мастере</legend>
            <input type="hidden" name="worker_id" value=<?= $worker_id ?>>
            <p><label>Фамилия: <input name="surname" value="<?= $worker['last_name'] ?>"></label></p>
            <p><label>Имя: <input name="name" value="<?= $worker['first_name'] ?>"></label></p>
            <p><label>Отчество: <input name="patronymic" value="<?= $worker['patronymic'] ?>"></label></p>
            <p><label>Дата рождения: <input type="date" name="date_of_birth"></label></p>
        </fieldset>

        <H4> Рабочая информация о мастере </H4>
        <fieldset>
            <legend> Специализация</legend>
            <?php foreach ($event->getSpecialization() as $item): ?>
                <?php if ($item['id'] == $worker['specialization_id']): ?>
                    <p><label> <input type="radio" name="specialization_id"
                                      value="<?= $item['id'] ?>" checked> <?= $item['title'] ?>
                        </label></p>
                <?php else: ?>
                    <p><label> <input type="radio" name="specialization_id"
                                      value="<?= $item['id'] ?>"> <?= $item['title'] ?>
                        </label></p>
                <?php endif; ?>
            <?php endforeach; ?>
        </fieldset>

        <h4></h4>
        <fieldset>
            <legend> Работы, которые может выполнять мастер</legend>
            <?php foreach ($event->getServices() as $item): ?>
                <?php if ($event->canWorkerServices($worker_id, $item['id'])): ?>
                    <p><label> <input type="checkbox" name="name_of_service[]"
                                      value="<?= $item['id'] ?>" checked> <?= $item['name_of_service'] ?> </label></p>
                <?php else: ?>
                    <p><label> <input type="checkbox" name="name_of_service[]"
                                      value="<?= $item['id'] ?>"> <?= $item['name_of_service'] ?> </label></p>
                <?php endif; ?>
            <?php endforeach; ?>
        </fieldset>

        <p><label>Процент выручки: <input type="number" min="1" max="100" name="percentage_of_revenue"
                                          value="<?= $worker['percentage_of_revenue'] ?>"></label>
        </p>

        <p>
            <button style="font-size: 16px">Отправить данные</button>
        </p>
    </form>

    <form method="post" enctype="application/x-www-form-urlencoded" action="../index.php">
        <button style="font-size: 16px">Вернуться на главный экран</button>
    </form>
</div>
</body>
</html>
