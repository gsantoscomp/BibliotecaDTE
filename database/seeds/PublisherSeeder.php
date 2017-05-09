<?php

use Illuminate\Database\Seeder;
use App\Models\Publisher;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('pt_BR');
        for ($i = 0; $i < 5; $i++) {
            $publisher = new Publisher();
            $publisher->pub_name = $faker->company;
            $publisher->save();
        }
    }
}
