<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Logwork;
use Illuminate\Support\Facades\DB;
use Auth;
use Hash;

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

        $user_logs = DB::table('users')
        ->join('logworks', 'logworks.user_id', '=','users.id')
        ->where('users.id','=',$id)
        ->select('logworks.id','logworks.description',
                  'logworks.houre','logworks.minute',
                 'logworks.created_at','logworks.updated_at');

        $user_logs_comments = DB::table('users')
        ->join('comments', 'comments.user_id', '=','users.id')
        ->where('users.id','=',$id)
        ->select('comments.id','comments.description',
                 DB::raw("NULL As hour"),DB::raw("NULL As minute"),
                'comments.created_at','comments.updated_at')
        ->unionAll($user_logs)
        ->get();

        $user_all_activities= $user_logs_comments->sortByDesc('created_at');
        return view('user', compact('users', 'user_all_activities'));
    }
    /////////////////////////////////////////////////////////
    public function index()
    {
        return view('changePassword');
    } 
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        return redirect()->back() ->with('alert', 'Password change successfully.');
    }

}

