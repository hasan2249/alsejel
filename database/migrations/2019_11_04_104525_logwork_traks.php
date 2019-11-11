<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LogworkTraks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logwork_tracks', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('description');
            $table->float('work_duration');
            $table->integer('logwork_id')->unsigned();
            $table->foreign('logwork_id')->references('id')->on('logworks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logwork_tracks');
    }
}
