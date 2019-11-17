<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Logwork;
use Illuminate\Support\Facades\DB;

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

        $user_comments = $users->comment()->orderBy('created_at','desc')->get();
        $user_logs = $users->logwork()->orderBy('created_at','desc')->get();

        $user_all = DB::table('users')
            ->where('users.id',$id)
            ->join('logworks', 'users.id', '=', 'logworks.user_id')
            ->join('comments', 'users.id', '=', 'comments.user_id')
            ->select('users.*', 'logworks.*', 'comments.*')
            ->distinct()
            ->get();


//        $user_comment = DB::table("comments")->where('id',$id)->orderBy('created_at','desc');
//        $user_log = DB::table("logworks")->where('id',$id)->orderBy('created_at','desc');
//        $user_activities = [$user_logs , $user_comments];



        return view('user', compact('users','user_comments', 'user_all'));
    }
    /////////////////////////////////////////////////////////
}
