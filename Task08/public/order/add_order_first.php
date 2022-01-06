<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Предварительная запись</title>
</head>
<body>
    <?php
        require_once '../Events.php';
        $event = new Events('../../data/service_station.db');
    ?>
    <form method="post" enctype="application/x-www-form-urlencoded" action="add_order_second.php">
        <label>
            <h2> Выбрать услугу</h2>
            <select style="width: 200px;" name="id_service">
                </option>
                <?php foreach ($event->getWorkPerformed() as $service): ?>
                    <option value=<?= $service['id']?>>
                        <?= $service['name_of_service'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>
        <button type="submit">Поиск по названию услуги</button>
    </form>
</body>
</html>
