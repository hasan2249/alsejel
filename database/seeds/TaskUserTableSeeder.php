<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TaskUserTableSeeder extends Seeder
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
        foreach (range(1,150) as $index) {
            DB::table('task_user')->insert([
                'user_id' => $faker->numberBetween(1,10),
                'task_id' => $faker->numberBetween(1,50),
                'created_at' => $faker->date('Y-m-d H:i:s'),
            ]);
        }
    }
}
