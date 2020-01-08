<?php

namespace App\Http\Controllers;
use App\Task;
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
        return view('user', compact('users'));
    }

    public function load_user_activities_data($id,Request $request)
    {
        $users = User::find($id);
        $user_logs = DB::table('users')
            ->join('logworks', 'logworks.user_id', '=','users.id')
            ->where('users.id','=',$id)
            ->select('logworks.task_id','logworks.id','logworks.description',
                'logworks.houre','logworks.minute',
                'logworks.created_at','logworks.updated_at');

        $user_logs_comments = DB::table('users')
            ->join('comments', 'comments.user_id', '=','users.id')
            ->where('users.id','=',$id)
            ->select('comments.task_id','comments.id','comments.description',
                DB::raw("NULL As hour"),DB::raw("NULL As minute"),
                'comments.created_at','comments.updated_at')
            ->unionAll($user_logs)
            ->get();

        $user_all_activities= $user_logs_comments->sortByDesc('updated_at');
        $num_of_records = 10;
        if($request->ajax())
        {
            if($request->updated_at > 0)
            {
                $user_some_activities = $user_all_activities->where('updated_at', '<', $request->updated_at)->take($num_of_records);
            }
            else
            {
                $user_some_activities = $user_all_activities->take($num_of_records);
            }
            $output = '';
            $last_date = '';

            if(!$user_some_activities->isEmpty())
            {
                foreach($user_some_activities as $activity)
                {
                    $output .= "
                    <div class = 'issue-data-block' >
                    <div class='actionContainer'>
                        <div class='action-details'>
                            <a href="."/user/".$users->id.">".$users->name."</a> -
                            <span title='Rule: 1' class='subText'><span class='date'>".
                        ( $activity->updated_at > $activity->created_at ?
                            (empty($activity->hour)  && empty($activity->minute)?
                            "Updated his comment on <a href="."/task/".User::find($activity->task_id)->id.">". Task::find($activity->task_id)->name ."</a> at: ". $activity->updated_at."." :
                            "Updated his log on <a href="."/task/".User::find($activity->task_id)->id.">". Task::find($activity->task_id)->name ."</a> at: ". $activity->updated_at. ", to ".  $activity->hour ." hours and ". $activity->minute ." minutes.") :
                            (empty($activity->hour)  && empty($activity->minute)?
                                    "Added a new comment on <a href="."/task/".User::find($activity->task_id)->id.">". Task::find($activity->task_id)->name ."</a> at: ". $activity->updated_at.".":
                                    "Logged work on <a href="."/task/".User::find($activity->task_id)->id.">". Task::find($activity->task_id)->name ."</a> at: ". $activity->updated_at." , with ". $activity->hour ." hours and ". $activity->minute." minutes.")).
                            "</span></span>
                        </div>
                            <div class='action-body'>
                                <ul id='worklog_details_142295' class='item-details'>
                                <li>
                                <dl>
                                <dt>&nbsp;</dt>
                                <dd id='wl-142295-c' class='worklog-comment'>
                                <p>$activity->description.</p>
                                </dd>
                                </dl>
                                </li>
                                </ul>
                            </div>
                    </div>
                    </div>
                    ";
                    $last_date = $activity->updated_at;
                }
                if (!(count($user_some_activities) < $num_of_records))
                {
                    $output .= '
                                <div class="col-md-8 offset-md-4">
                                <div id="user_activities_load_more">
                                    <button type="button" name="load_more_user_activities_button" class="btn-link" data-updated_at="'.$last_date.'" id="load_more_user_activities_button">Load More</button>
                                </div>
                                </div>
                                ';
                }
            }
            echo $output;
        }
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
//            'current_password' =>  'required|old_password:' . Auth::user()->password,
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
    }

    public function store(Request $request)
    {
        if ($this->validatorPassword($request->toArray())->fails())
        {
           return redirect()->back()->withErrors($this->validator($request->toArray()))->withInput();
        }
        else
        {
            User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
            return redirect()->back() ->with('alert', 'Password change successfully.');
        }
       
    }
    protected function validatorImage(array $data)
    {
        return Validator::make($data, [
            'image' => 'required|image|mimes:png,jpg,jpeg|max:10000',
        ]);
    }
    public function updateProfile(Request $request)
    {
        if ($this->validatorImage($request->toArray())->fails())
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

