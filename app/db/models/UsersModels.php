<?php

namespace App\DB\Models;

use App\DB\Model;

class UsersModels extends Model
{
    public String $table_name = "users";

    public array $model_columns = [
        'name',
        'email',
        'password'
    ];

    public function __construct() {
        parent::__construct($this->model_columns);
    }
}
