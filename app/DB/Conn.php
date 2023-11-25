<?php

namespace App\DB;

use PDO;
use App\DB\Storage\DadoStorage;

class Conn
{
    protected $db;

    public function __construct()
    {
        $localhost_db = getenv('DB_HOST');
        $dbname_db = getenv('DB_NAME');
        $user_db = getenv('DB_USER');
        $password_db = getenv('DB_PASSWORD');

        $pdo = new PDO("pgsql:host=$localhost_db; dbname=$dbname_db", $user_db, $password_db, []);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->db = $pdo;
    }
    
    public function connect()
    {
        return $this->db;
    }
}
