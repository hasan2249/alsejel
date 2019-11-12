<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
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
//        $user = Array('user' => $users);
//        $tasks = $users->task()->name;//->simplePaginate(15);
//        $comments_logs=User::join('comments','users.id','=','comments.user_id')->join('logworks','users.id','=','logworks.user_id')
//            ->select('comments.description', 'logworks.work_duration', 'logworks.description')
//            ->orderby('comments.created_at')
//            ->orderby('logworks.created_at')
//            ->get();
//        $comments_logs =
//            DB::table('users')
//                ->join('comments', 'users.id', '=', 'comments.user_id')
//                ->where('comments.user_id','=',$id)
//                ->join('logworks', 'users.id', '=', 'logworks.user_id')
//                ->where('logworks.user_id','=',$id)
//                ->select('comments.description','logworks.work_duration')
//                ->orderby('comments.created_at')
//                ->get();
        $user_comments = $users->comment()->orderBy('created_at','desc')->simplePaginate(6);
        $user_logs = $users->logwork()->orderBy('created_at','desc')->simplePaginate(6);;
        return view('user', compact('users','user_comments', 'user_logs'));
    }
    /////////////////////////////////////////////////////////
}
