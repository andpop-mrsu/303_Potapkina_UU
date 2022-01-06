<?php

class Events
{
    private PDO $pdo;

    public function __construct(string $path)
    {
        $this->pdo = new PDO('sqlite:' . $path);
    }

    public function getWorkers(): bool|array
    {
        $query = "select * from workers where status = 'является работником';";
        $statement = $this->pdo->query($query);
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        return $rows;
    }

    public function getWorkerById(string $worker_id)
    {
        $query = "select * from workers where id = " . $worker_id . ";";
        $statement = $this->pdo->query($query);
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        return $rows[0];
    }

    public function getSpecialization(): bool|array
    {
        $query = "select * from specialization;";
        $statement = $this->pdo->query($query);
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        return $rows;
    }

    public function getSpecializationById(string $specialization_id)
    {
        $query = "select id, title from specialization where id = " . $specialization_id . ";";
        $statement = $this->pdo->query($query);
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        return $rows[0]['title'];
    }

    public function getServices(): bool|array
    {
        $query = "select * from services;";
        $statement = $this->pdo->query($query);
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        return $rows;
    }

    public function getWorkersBusynessByWorkerId(string $worker_id): bool|array
    {
        $query = "select wb.id, b.'data', b.work_hours_start, b.work_hours_end "
            . " from workers_busyness wb join busyness b on wb.busyness_id = b.id "
            . "where is_actual = 'да' and wb.worker_id = " . $worker_id . " order by data;";
        $statement = $this->pdo->query($query);
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        return $rows;
    }

    public function getOrdersByWorkerIdByDate(String $worker_id, String $date)
    {
        $query = "select service_execution_time from orders o where worker_id = " . $worker_id .
            " and substr(service_execution_time, 1,  10) = '" . $date . "';";
        $statement = $this->pdo->query($query);
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        return $rows;
    }

    public function getWorkPerformedByWorker(String $worker_id): bool|array
    {
        $query = 'select s.name_of_service, o.service_execution_time, scc.duration_in_hours, scc.price ' .
            'FROM orders_services_car_categories oscc ' .
            'join services_car_categories scc, orders o, services s on oscc.orders_id = o.id ' .
            'and oscc.services_car_categories_id = scc .id and scc.service_id = s.id ' .
            'where o.worker_id = ' . $worker_id .';';
        $statement = $this->pdo->query($query);
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        return $rows;
    }

    public function getWorkersBusynessById(String $wb_id)
    {
        $query = "select * from workers_busyness where id =". $wb_id .";";
        $statement = $this->pdo->query($query);
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        return $rows[0];
    }

    public function getBusynessById(String $busyness_id)
    {
        $query = "select * from busyness where id =". $busyness_id .";";
        $statement = $this->pdo->query($query);
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        return $rows[0];
    }

    public function canWorkerServices(string $worker_id, string $service_id)
    {
        $query = "select * from workers_services where worker_id = " . $worker_id .
            " and service_id = ". $service_id ." and is_action = 'да';";
        $statement = $this->pdo->query($query);
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        return count($rows) > 0;
    }
}