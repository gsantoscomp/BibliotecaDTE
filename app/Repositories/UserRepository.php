<?php
/**
 * Created by PhpStorm.
 * User: uemanet
 * Date: 10/05/17
 * Time: 14:32
 */

namespace App\Repositories;


use App\Models\User;
use DB;
class UserRepository
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

    public function addUser($request)
    {
        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        $user->save();

        return $user;
    }
}