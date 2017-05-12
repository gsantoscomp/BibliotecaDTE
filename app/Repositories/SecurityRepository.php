<?php

namespace App\Repositories;

use DB;
use Cache;
use Auth;
use Config;

class SecurityRepository
{

    public function getPermissions($id)
    {
        $query = DB::table('permissions')
                    ->join('roles_permissions as rp', 'permissions.id', '=', 'rp.permission_id')
                    ->join('roles', 'rp.role_id', '=', 'roles.id')
                    ->join('users_roles as ur', 'roles.id', '=', 'ur.role_id')
                    ->where('ur.user_id', '=', $id)
                    ->select('permissions.*')
                    ->distinct()
                    ->get();

        return $query;
    }

    public function getRole($id)
    {
        $query = DB::table('roles')
            ->join('users_roles as ur', 'roles.id', '=', 'ur.role_id')
            ->join('users', 'users.id', '=', 'ur.user_id')
            ->where('ur.user_id', '=', $id)
            ->select('roles.*')
            ->first();

        return $query;
    }

    public function makeCachePermissions($userId)
    {
        $permissions = $this->getPermissions($userId);

        $arrPermissions = [];

        foreach ($permissions as $permission)
        {
            $arrPermissions[] = $permission->route;
        }

        Cache::forever('PERMISSIONS_'.$userId, $arrPermissions);
    }

    public function hasPermission($route)
    {
        if (!Auth::check())
        {
            $routesPreLogin = Config::get('security.routes_prelogin');

            return in_array($route, $routesPreLogin);
        }

        $user = Auth::user();

        $permissions = Cache::get('PERMISSIONS_'.$user->id);

        if (in_array($route, $permissions)) {

            return true;
        }

        $routes_poslogin = Config::get('security.routes_poslogin');

        if (in_array($route, $routes_poslogin)) {
            return true;
        }

        return false;
    }
}