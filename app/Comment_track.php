<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment_track extends Model
{
    //
    public $table = "comment_tracks";
    public function comment()
    {
        return $this->belongsto('App\Comment','comment_id');
    }
}
