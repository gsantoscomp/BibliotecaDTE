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

        $bookDestroy = Permission::create([
            'name' => 'book.destroy',
            'route' => 'book.destroy'
        ]);

        $userDestroy = Permission::create([
            'name' => 'user.destroy',
            'route' => 'user.destroy'
        ]);

        $loanDestroy = Permission::create([
            'name' => 'loan.destroy',
            'route' => 'loan.destroy'
        ]);

        $arrPermissions = [
            $userManagement->id,
            $bookManagement->id,
            $loanManagement->id,
            $bookDestroy->id,
            $userDestroy->id,
            $loanDestroy->id
        ];

        $roleAdmin = Role::where('id', 1)->first();
        $roleUser = Role::where('id', 2)->first();


        $roleAdmin->permissions()->attach($arrPermissions);
        $roleUser->permissions()->attach($index->id);
    }
}