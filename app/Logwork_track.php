<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logwork_track extends Model
{
    //
    
    public $table = "logwork_tracks";
    public function logwork()
    {
        return $this->belongsto('App\Logwork','logwork_id');
    }
}
