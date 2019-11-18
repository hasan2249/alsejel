<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(TaskTableSeeder::class);
         $this->call(UserTableSeeder::class);
         $this->call(logworks::class);
         $this->call(TaskUserTableSeeder::class);
         $this->call(commentsTableSeeder::class);
    }
}
