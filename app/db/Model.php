<?php

namespace App\DB;

class Model
{
    public String $columns = '';

    public String $placeholders = '';

    public function __construct($columns)
    {
        $this->columns = implode(',', $columns);
        $this->placeholders = implode(',', array_map(function($column) {
            return ':'.$column;
        }, $columns));
    }
}
