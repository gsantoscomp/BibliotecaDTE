<?php
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        $arrPermissions = [];

        $permission = Permission::create([
            'name' => 'index',
            'route' => 'index'
        ]);

        $arrPermissions[] = $permission->id;

        $roleAdmin = Role::where('id', 1)->first();

        $roleAdmin->permissions()->attach($arrPermissions);
    }
}