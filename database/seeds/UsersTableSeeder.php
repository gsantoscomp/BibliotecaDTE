<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('pt_BR');
        for($i = 0; $i < 6; $i++){
            $user = new User();
            if($i == 0){
                $user->name = 'admin';
                $user->email = 'admin@admin.com';
                $user->password = bcrypt('123456');
            }
            elseif ($i == 1)
            {
                $user->name = 'user';
                $user->email = 'user@user.com';
                $user->password = bcrypt('123456');
            }
            else{
                $user->name = $faker->lastName;
                $user->email = $faker->email;
                $user->password = bcrypt('123456');
            }
            $user->save();
        }
    }
}
