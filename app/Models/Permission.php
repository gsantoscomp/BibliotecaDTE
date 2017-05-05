<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';
    protected $fillable = [
        'name', 'route', 'description'
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'roles_permissions', 'permission_id', 'role_id');
    }

}
