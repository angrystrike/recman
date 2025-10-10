<?php

namespace models;

use components\DB;
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
            "INSERT INTO {$this->table} (first_name, last_name, phone, email, password) 
                      VALUES (?, ?, ?, ?, ?, ?, ?)"
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


    public function update(array $data)
    {
        $query = $this->db->prepare("UPDATE {$this->table} SET company = ?, `position` = ?, about_me = ?, photo_name = ? WHERE id = ?");
        $query->execute([
            $data['company'],
            $data['position'],
            $data['about_me'],
            $data['photo_name'],
            $_SESSION['member_id']
        ]);

    }

    public static function isEmailInUse($email)
    {
        $db = DB::getConnection();
        $query = $db->prepare("SELECT * FROM members WHERE email = ? AND id != ?");
        $id = 0;
        if (!empty($_SESSION['member_id'])) {
            $id = $_SESSION['member_id'];
        }

        $query->execute([$email, $id]);

        return $query->rowCount() != 0;
    }

    public function edit(array $data)
    {
        $query = $this->db->prepare(
            'UPDATE members SET first_name = ?, last_name = ?, birth_date = ?, report_subject = ?, country = ?, phone_number = ?, email = ? WHERE id = ?'
        );
        $query->execute([
            $data['first_name'],
            $data['last_name'],
            $data['birth_date'],
            $data['report_subject'],
            $data['country'],
            $data['phone_number'],
            $data['email'],
            $_SESSION['member_id']
        ]);
    }


}