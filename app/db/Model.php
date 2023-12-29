<?php

namespace App\DB;

use PDO;

class Model extends Storage
{
    public $tableName;

    public $mappedFields;

    public $ignoreFields;

    public $placeholders;
    
    public $fields;

    public $values;

    public function __construct($fields)
    {
        $this->prepareFields($fields);
        parent::__construct();
    }

    public function save()
    {
        $query = $this->conn->prepare("INSERT INTO $this->tableName ($this->fields) VALUES ($this->placeholders)");
        $query->execute($this->values);
    }

    public function find($parameters, $findOne = false)
    {
        $selectColumns = $this->prepareFieldsForSelect();

        $sql = "SELECT $selectColumns FROM $this->tableName WHERE ";
        $total = count($parameters);

        foreach($parameters as $column => $value) {
            $sql .= " $column = '$value' ";
            $total -= 1;

            if ($total > 0) {
                $sql .= "AND";
            }
        }

        $query = $this->conn->query($sql);

        $result = false;
        if ($findOne) {
            $result = $query->fetch(PDO::FETCH_OBJ);
        } else {
            $result = $query->fetchAll(PDO::FETCH_OBJ);
        }

        return $result;
    }

    protected function prepareFields($fields)
    {
        $this->values = $fields;
        $this->fields = implode(',', array_keys($fields));

        $this->placeholders = implode(',', array_map(function($field) {
            return ':'.$field;
        }, array_keys($fields)));
    }

    protected function prepareFieldsForSelect()
    {
        $mappedFields = [];
        foreach ($this->mappedFields as $mappedField)
        {
            if (!in_array($mappedField, $this->ignoreFields)){
                $mappedFields[] = $mappedField;
            }
        }

        return implode(',', $mappedFields);
    }
}
