<?php


use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Faker\Factory as Faker;

class TaskTableSeeder extends Seeder
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
        foreach (range(1,50) as $index) {
            DB::table('tasks')->insert([
                'name' => $faker->name,
                'type' => $faker->word,
                'description' => $faker->paragraph,         
                'state' => $faker->word,
                'created_at' => $faker->date('Y-m-d H:i:s'),
            ]);
        }
    }
}
