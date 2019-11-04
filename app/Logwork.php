<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logwork extends Model
{
    //
    public $table = "logworks";
    public function user()
    {
        return $this->belongsto('App\User','user_id');
    }

    public function task()
    {
        return $this->belongsto('App\Task','task_id');
    }

    public function logwork_track()
    {
        return $this->hasMany('App\Logwork_trak','logwork_id');
    }
}
