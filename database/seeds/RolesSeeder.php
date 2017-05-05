<?php
use App\Models\Role;
use Illuminate\Database\Seeder;

/**
 * Created by PhpStorm.
 * User: uemanet
 * Date: 04/05/17
 * Time: 16:20
 */
class RolesSeeder extends Seeder
{
    public function run()
    {
        Role::create([
           'name' => 'Admin'
        ]);
    }
}