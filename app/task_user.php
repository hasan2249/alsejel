<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class task_user extends Model
{
    // Many to Many table

    public $table = "task_user";
    public $timestamp = false;
}
