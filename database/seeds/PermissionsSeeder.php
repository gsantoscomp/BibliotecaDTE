<?php
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        $index = Permission::create([
            'name' => 'index',
            'route' => 'index'
        ]);

        $userManagement = Permission::create([
            'name' => 'usermanagement',
            'route' => 'usermanagement'
        ]);

        $bookManagement = Permission::create([
            'name' => 'bookmanagement',
            'route' => 'bookmanagement'
        ]);

        $loanManagement = Permission::create([
            'name' => 'loanmanagement',
            'route' => 'loanmanagement'
        ]);

        $arrPermissions = [
            $index->id,
            $userManagement->id,
            $bookManagement->id,
            $loanManagement->id
        ];

        $roleAdmin = Role::where('id', 1)->first();

//        $roleUSer = Role::where()->first();

        $roleAdmin->permissions()->attach($arrPermissions);
    }
}