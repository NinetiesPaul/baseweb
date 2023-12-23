<?php

namespace App\DB;

use PDO;

class Storage
{
    protected $conn;

    public function __construct()
    {
        $localhost_db = getenv('DB_HOST');
        $dbname_db = getenv('DB_NAME');
        $user_db = getenv('DB_USER');
        $password_db = getenv('DB_PASSWORD');

        $pdo = new PDO("mysql:host=$localhost_db; dbname=$dbname_db", $user_db, $password_db, []);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->conn = $pdo;
    }

    public function save($model, $values)
    {
        $query = $this->conn->prepare("INSERT INTO $model->table_name ($model->columns) VALUES ($model->placeholders)");
        $query->execute($values);
    }
}
