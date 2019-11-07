<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    public $table = "tasks";
    public function comment()
    {
        return $this->hasMany('App\Comment','task_id');
    }

    public function logwork()
    {
        return $this->hasMany('App\Logwork','task_id');
    }

    public function user()
    {
        return $this->hasMany('App\User','task_user');
    }
    public function users()
    {
        return $this->belongsToMany('App\User','task_user','user_id','task_id')->withPivot('user_id')->withTimestamps();
    }
}
