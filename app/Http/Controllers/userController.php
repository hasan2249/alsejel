<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class userController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    ////////////////////////////////////////////////////////
    // Testing purposes
    /////////////

    // this function only for test the users page
    public function users_page() {
        $users = User::all();
        $user = Array("users" => $users);
        return view('users', $user);
    }

    public function user_page($id) {
        $users = User::find($id);
        $user = Array('user' => $users);
        //$tasks = $users->task()->name;//->simplePaginate(15);
        $comments_logs=User::join('comments','users.id','=','comments.user_id')->join('logworks','users.id','=','logworks.user_id')
            ->select('comments.description', 'logworks.work_duration', 'logworks.description')
            ->orderby('comments.created_at')
            ->orderby('logworks.created_at')
            ->get();;
        return view('user', compact('users','comments_logs'));
    }
    /////////////////////////////////////////////////////////
}
