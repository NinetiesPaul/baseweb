<?php

namespace App\DB\Models;

use App\DB\Model;

class UsersModels extends Model
{
    public $tableName = "users";

    public $mappedFields = [
        'id',
        'name',
        'email',
        'password'
    ];

    public $ignoreFields = [
        'password'
    ];

    public function __construct($fields = []) {
        parent::__construct($fields);
    }
}
