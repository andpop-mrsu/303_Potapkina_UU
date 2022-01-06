<?php
declare(strict_types=1);

class Events
{
    private PDO $pdo;

    public function __construct(String $path)
    {
        $this->pdo = new PDO('sqlite:' . $path);
    }

    public function getSpecialization()
    {
        $query = "select id, title from specialization";
        $statement = $this->pdo->query($query);
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        return $rows;
    }

    public function getWorkPerformed()
    {
        $query = "select id, name_of_service from services";
        $statement = $this->pdo->query($query);
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        return $rows;
    }

    public function getWorkers()
    {
        $query = "select id, last_name, first_name, patronymic from workers";
        $statement = $this->pdo->query($query);
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        return $rows;
    }

    public function getWorkerForID(String $idWorker)
    {
        $query = "select id, last_name, first_name, patronymic from workers where id =" .$idWorker;
        $statement = $this->pdo->query($query);
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        return $rows;
    }

    public function getNameService(string $idService)
    {
        $query = "select name_of_service from services where (id = ". $idService . ");";
        $statement = $this->pdo->query($query);
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        return $rows;
    }

    public function getWorkersForIDS(string $idService)
    {
        $query = "select worker_id from workers_services where (service_id = ". $idService . ");";
        $statement = $this->pdo->query($query);
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        return $rows;
    }

    public function getCarCategories(String $id_service)
    {
        $query = "select cc.id, cc.description from services_car_categories scc join car_categories cc on scc.car_category_id = cc.id where scc.service_id =". $id_service." order by cc.id;";
        $statement = $this->pdo->query($query);
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        return $rows;
    }

    public function getCarCategoriesId(String $id_car_category)
    {
        $query = "select id, description from car_categories where car_categories.id = ". $id_car_category.";";
        $statement = $this->pdo->query($query);
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        return $rows;
    }

    public function getByusyness(String $id_worker)
    {
        $query = 'select b."data", b.work_hours_start, b.work_hours_end from workers_busyness wb join busyness b on wb.busyness_id = b.id where wb.worker_id = '. $id_worker.";";
        $statement = $this->pdo->query($query);
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        return $rows;
    }

    public function getByusynessData(String $id_worker, String $data)
    {
        $query = 'select service_execution_time from orders o where worker_id = ' . $id_worker .
            ' and substr(service_execution_time, 1,  10) = "' . $data . '";';
        $statement = $this->pdo->query($query);
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        return $rows;
    }

    public function getIdSCC(String $id_service, String $id_car_category)
    {
        $query = 'select id, duration_in_hours, price from services_car_categories where service_id = ' . $id_service .
            ' and car_category_id = ' . $id_car_category . ';';
        $statement = $this->pdo->query($query);
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        return $rows;
    }
}