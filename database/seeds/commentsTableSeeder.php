<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class commentsTableSeeder extends Seeder
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
        foreach (range(1,400) as $index) {
            DB::table('comments')->insert([
                'description' => $faker->paragraph,
                'created_at' => $faker->date('Y-m-d H:i:s'),
                'updated_at' => $faker->date('Y-m-d H:i:s'),
                'task_id' => $faker->numberBetween(1,50),
                'user_id' => $faker->numberBetween(1,10),  
                'created_at' => $faker->date('Y-m-d H:i:s'),
                'updated_at' => $faker->date('Y-m-d H:i:s'), 
            ]);
    }
}
}
