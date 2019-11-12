<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','rule', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function comment()
    {
        return $this->hasMany('App\Comment','user_id');
    }

    public function logwork()
    {
        return $this->hasMany('App\Logwork','user_id');
    }

    public function task()
    {
        return $this->hasMany('App\Task','task_user');
    }
    public function tasks()
    {
        return $this->belongsToMany('App\Task');
    }
}
