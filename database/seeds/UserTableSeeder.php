<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserTableSeeder extends Seeder
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
        foreach (range(1,10) as $index) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->email,
                'rule' => $faker->numberBetween(1,3),         
                'password' => bcrypt('secret'),
                'created_at' => $faker->date('Y-m-d H:i:s'),
            ]);
    }
}
}