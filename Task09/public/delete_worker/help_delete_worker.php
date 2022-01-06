<?php
$pdo = new PDO('sqlite:../../data/service_station.db');

$worker_id = $_POST['worker_id'];


$query = "UPDATE 'workers' SET status='не является работником' WHERE workers.id=". $worker_id.";";
$statement = $pdo->prepare($query);
$statement->execute();

?>


<!DOCTYPE html>
<html lang="ru">
<body style="font-size: 20px; padding: 0 5%">
<div>
    <h1>Запись из мастера успешно удалена</h1>

    <form method="post" enctype="application/x-www-form-urlencoded" action="../index.php">
        <button style="font-size: 16px">Вернуться на главный экран</button>
    </form>
</div>
</body>
</html>