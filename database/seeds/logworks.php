<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class logworks extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create();
        foreach (range(1,100) as $index) {
            DB::table('logworks')->insert([
                'description' => $faker->paragraph,
                'date' => $faker->date('Y-m-d H:i:s'),
                'houre' => $faker->numberBetween(1,8),
                'minute' => $faker->numberBetween(1,60),
                'task_id' => $faker->numberBetween(1,50),
                'user_id' => $faker->numberBetween(1,10),  
                'created_at' => $faker->date('Y-m-d H:i:s'),
                'updated_at' => $faker->date('Y-m-d H:i:s'), 
            ]);
        }
    }
}
