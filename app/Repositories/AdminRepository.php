<?php

namespace App\Repositories;

use DB;

class AdminRepository
{
    public function getUser()
    {
        $query = DB::table('users')
                    ->join('users_roles as ur', 'users.id', '=', 'ur.user_id')
                    ->join('roles', 'ur.role_id', '=', 'roles.id')
                    ->select('users.*', 'roles.name as role')
                    ->get();

        return $query;
    }
}