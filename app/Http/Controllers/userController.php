<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Logwork;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
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
    public function index()
    {
        return view('changePassword');
    } 
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    protected function validatorPassword(array $data)
    {
        return Validator::make($data, [
            'current_password' => 'required|min:6|confirmed'
        ]);
    }
    public function store(Request $request)
    {
        if ($this->validatorPassword($request->toArray())->fails())
        {
            return redirect()->back()->with(['alert' => 'failed to change.']);
        }
        else
        {
            User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
            return redirect()->back() ->with('alert', 'Password change successfully.');
        }
       
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'image'=>'required|image|mimes:png,jpg,jpeg|max:10000'
        ]);
    }
    public function updateProfile(Request $request)
    {
        if ($this->validator($request->toArray())->fails())
        {
            return redirect()->back()->with(['alert' => 'failed to update.']);
        }
        else
        {
            $image = $request->file('image');
            $filename = $image->getClientOriginalName();
            $image->move(public_path('images'), $filename);
            $user=new User;
            $user->where('email', '=', Auth::user()->email)->update(['image' =>$filename]);
    
            return redirect()->back()->with(['alert' => 'Profile updated successfully.']);
        }
       
    }
}

