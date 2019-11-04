<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    public $table = "comments";
    public function user()
    {
        return $this->belongsto('App\User','user_id');
    }

    public function task()
    {
        return $this->belongsto('App\Task','task_id');
    }

    public function comment_track()
    {
        return $this->hasMany('App\Comment_trak','comment_id');
    }
}
