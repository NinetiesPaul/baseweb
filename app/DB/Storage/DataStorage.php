<?php

namespace App\DB\Storage;

use App\DB\DB;
use PDO;

class DataStorage extends DB
{   
    public function verDados()
    {
        $query = $this->connect()->query("SELECT * FROM dado");
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function verDado(int $aluno)
    {
        $query = $this->connect()->query("SELECT * FROM dado WHERE id = $aluno");
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function inserirDado($dado)
    {   
        $query = $this->connect()->prepare("INSERT INTO dado (dado) VALUES (:dado)");
        $query->execute([
            'dado' => $dado,
        ]);
    }

    public function atualizarDado($idDado, $dado)
    {
        $sql = 'UPDATE dado
            SET dado=:dado
            WHERE id=:idDado';

        $fields = [
            'dado' => $dado,
            'idDado' => $idDado,
        ];

        $query = $this->connect()->prepare($sql);
        $query->execute($fields);
    }

    public function removerDado($aluno)
    {
        $user = $this->connect()->prepare("DELETE FROM dado WHERE id = :id");
        $user->execute([
            'id' => $aluno,
        ]);
    }
}
