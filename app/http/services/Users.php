<?php

namespace App\Http\Services;

use App\DB\Models\Users as ModelsUsers;

class Users
{
    public function __construct()
    {
        
    }

    public function create($data)
    {
        $user = new ModelsUsers([
            'name' => $data['name'],
            'password' => $data['password'],
            'email' => $data['email'],
        ]);

        $user->save();
    }

    public function findAll()
    {
        $users = new ModelsUsers();
        return $users->find([], false);
    }

    public function findOne($data)
    {
        $users = new ModelsUsers();
        return $users->find($data, true);
    }

    public function update($data)
    {
        $users = new ModelsUsers($data);
        return $users->update($data['id']);
    }

    public function delete($id)
    {
        $users = new ModelsUsers();
        return $users->delete($id);
    }
}
