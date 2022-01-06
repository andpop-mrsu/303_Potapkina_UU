<?php
$pdo = new PDO('sqlite:../data/service_station.db');

for ($i = 1; $i <= 7; $i++)
    if (strcasecmp($_POST['id'], "") != 0 and strcasecmp($_POST['date' . $i], "") != 0 and strcasecmp($_POST['time' . $i . '_start'], "") != 0 and strcasecmp($_POST['time' . $i . '_end'], "") != 0) {
        $query = "insert into 'busyness'('data','work_hours_start','work_hours_end')" .
            " values (" . "'" . $_POST['date' . $i] . "','" . $_POST['time' . $i . '_start'] . "','" . $_POST['time' . $i . '_end'] . "');";
        $statement = $pdo->query($query);
        $last_row_id_b = $pdo->lastInsertID();
        $query = "INSERT INTO 'workers_busyness'('worker_id','busyness_id') VALUES (" . $_POST['id'] . "," . $last_row_id_b . ");";
        $statement = $pdo->query($query);
    }
?>

<body>
<form method="post" enctype="application/x-www-form-urlencoded" action="add_schedule.php">
    <p>
        <button>Вернуться к вводу информации о графике работы мастеров</button>
    </p>
</form>

<form method="post" enctype="application/x-www-form-urlencoded" action="../index.php">
    <p>
        <button>Вернуться к выбору формы для ввода</button>
    </p>
</form>
</body>
</html>

