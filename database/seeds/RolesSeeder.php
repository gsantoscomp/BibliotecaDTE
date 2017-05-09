<?php

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    public function run()
    {
        $adminRole = Role::create([
            'name' => 'Admin'
        ]);

        $userRole = Role::create([
            'name' => 'User'
        ]);

        $admin = User::where('id', 1)->first();
        $users = User::where('id', '>', 1)->get();

        $admin->roles()->attach($adminRole);

        foreach ($users as $user)
        {
            $user->roles()->attach($userRole);
        }
    }
}