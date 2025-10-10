<?php

namespace core;

use components\DB;
use PDO;

class Model extends DB
{
    public function __construct()
    {
        parent::__construct();
    }

    public function all()
    {
        $items = [];

        $result = $this->db->query("SELECT * FROM {$this->table}");
        $result->setFetchMode(PDO::FETCH_ASSOC);

        if ($result) {
            foreach ($result as $row) {
                $items[] = $row;
            }
        }

        return $items;
    }

    public function count()
    {
        $query = $this->db->prepare("SELECT COUNT(*) FROM {$this->table}");
        $query->execute();
        $count = $query->fetchColumn();
        
        return $count;
    }

    public function findOneById($id)
    {
        $query = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id LIMIT 1");
        $query->execute(['id' => $id]);
        $modelObject = $query->fetchObject();

        return $modelObject;
    }
}