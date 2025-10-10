<?php

namespace models;

use core\Model;

class Member extends Model
{
    public $table = 'members';

    public function __construct()
    {
        parent::__construct();
    }

    public function create(array $data)
    {
        $query = $this->db->prepare(
            "INSERT INTO {$this->table} (first_name, last_name, phone, email, password) VALUES (?, ?, ?, ?, ?)"
        );

        $query->execute([
            $data['first_name'],
            $data['last_name'],
            $data['phone'],
            $data['email'],
            $data['password'],
        ]);

        return $this->db->lastInsertId();
    }

    public function isEmailInUse($email)
    {
        $query = $this->db->prepare("SELECT * FROM members WHERE email = ? AND id != ?");
        $id = 0;

        $query->execute([$email, $id]);

        return $query->rowCount() != 0;
    }

    public function login(string $email, string $password): bool
    {
        $query = $this->db->prepare("SELECT * FROM {$this->table} WHERE email = ?");
        $query->execute([$email]);
        $user = $query->fetch(\PDO::FETCH_ASSOC);

        if (!$user) {
            return false;
        }

        if (!password_verify($password, $user['password'])) {
            return false;
        }

        return true;
    }
}