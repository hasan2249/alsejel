<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request ;
use Artisan;
use App\Task;
use App\Logwork;
use App\Comment;
use App\User;
use App\task_user;
use Redirect;
use Auth;
use DB;
class TaskController extends Controller
{
    // this functions are only avilable for authenticated users.
    public function __construct()
    {
        $this->middleware('auth');
    }

    ////////////////////////////////////////////////////////
    // show all tasks within DB
    public function tasks_page() {
        $tasks = Task::all()->sortByDesc('updated_at');
        $task = Array("tasks" => $tasks);
        return view('/tasks',$task);
    }
    //---------------------------------------------------- 


    ////////////////////////////////////////////////////////
    // show a specific task within DB by its id with the logworks
    /////////////
    public function task_page($id) {
        $tasks = Task::find($id);
        $logworks = Logwork::where('task_id', $id)->orderBy('date','desc')->get();
        $comments = Comment::where('task_id', $id)->orderBy('created_at','desc')->get();
        $bool = false;
        foreach ($tasks->user as $user)
        {
            if( Auth::user()->name  == $user->name)
            {
                $bool = true;
                break;
            }
        }

        //get the total number of hours
        $hours =0;
        $minuts =0;
        foreach ($logworks as $logwork)
        {
            $hours +=$logwork->houre ;
            $minuts += $logwork->minute ;
        }
        $total_hours = $hours + floor($minuts / 60);
        $total_minuts = floor($minuts % 60);
        $task = Array("task" => $tasks,"logworks" =>$logworks ,"comments" =>$comments ,"bool" =>$bool , "total_hours" =>$total_hours , "total_minuts" =>$total_minuts)  ;
        return view('/task',$task);
    }

    public function load_task_activities_data($id,Request $request)
    {
        $tasks = Task::find($id);
        $task_logs = DB::table('tasks')
            ->join('logworks', 'logworks.task_id', '=','tasks.id')
            ->where('tasks.id','=',$id)
            ->select('logworks.id','logworks.description',
                'logworks.houre','logworks.minute',
                'logworks.created_at','logworks.updated_at');

        $task_logs_comments = DB::table('tasks')
            ->join('comments', 'comments.task_id', '=','tasks.id')
            ->where('tasks.id','=',$id)
            ->select('comments.id','comments.description',
                DB::raw("NULL As hour"),DB::raw("NULL As minute"),
                'comments.created_at','comments.updated_at')
            ->unionAll($task_logs)
            ->get();

        $task_all_activities= $task_logs_comments->sortByDesc('updated_at');

        $num_of_records = 10;
        if($request->ajax())
        {
            if($request->updated_at > 0)
            {
                $task_some_activities = $task_all_activities->where('updated_at', '<', $request->updated_at)->take($num_of_records);
            }
            else
            {
                $task_some_activities = $task_all_activities->take($num_of_records);
            }
            $output = '';
            $last_date = '';

            if(!$task_some_activities->isEmpty())
            {
                foreach($task_some_activities as $activity)
                {
                    $output .= "
                    <div class = 'issue-data-block' >
                    <div class='actionContainer'>
                        <div class='action-details'>
                            <a href='#'>".$tasks->name."</a> -
                            <span title='Rule: 1' class='subText'><span class='date'>".
                        ( $activity->updated_at > $activity->created_at ?
                            (empty($activity->hour) ?
                                "Updated his comment at: ". $activity->updated_at."." :
                                "Updated his log  at: ". $activity->updated_at. ", to ".  $activity->hour ." hours and ". $activity->minute ." minutes.") :
                            (empty($activity->hour)?
                                "Added a new comment at: ". $activity->updated_at.".":
                                "Logged work at: ". $activity->updated_at." , with ". $activity->hour ." hours and ". $activity->minute." minutes.")).
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
                if (!(count($task_some_activities) < $num_of_records))
                {
                    $output .= '

       <div class="col-md-8 offset-md-4">
       <div id="task_activities_load_more">
        <button type="button" name="load_more_task_activities_button" class="btn-link" data-updated_at="'.$last_date.'" id="load_more_task_activities_button">Load More</button>
       </div>
       
       </div>
       ';
                }
            }
            echo $output;
        }
    }
     //----------------------------------------------------



    ////////////////////////////////////////////////////////
    // save logwork for a specific user on a specific task
    // $id : id of task.
    // $req : object contain the information from a "form" inside "task.blade.php"
    public function logwork(Request $req, $id) {
        $logwork = new Logwork();
        $logwork->description = $req['description']; // I can type $req->input('description');
        $logwork->houre = $req['houres'];
        $logwork->minute = $req['minutes'];
        $logwork->date = $req['date'];
        $logwork->task_id = $id;
        $logwork->user_id = Auth::user()->id;
        $logwork->save();
        return Redirect::back();
    }

    public function editLogwork(Request $req, $id) {
        $logwork = Logwork::find($id);
        $logwork->description = $req['description']; // I can type $req->input('description');
        $logwork->houre = $req['houres'];
        $logwork->minute = $req['minutes'];
        $logwork->date = $req['date'];
        $logwork->save();
        return Redirect::back();
    }

    public function deleteLogwork(Request $req, $id) {
        $task = Logwork::find($id);
        $task->delete();
        return Redirect::back();
     }

    public function join(Request $req, $id)
    {
      $task_use = new task_user();
      $task_use->user_id = Auth::user()->id;
      $task_use->task_id = $id;
      $task_use->save();
      return Redirect::back();
    }

    public function left(Request $req, $id)
    {
        DB::table('task_user')->where([['task_id', $id],['user_id',Auth::user()->id]])->delete();
      return Redirect::back();
    }
     //----------------------------------------------------

     public function editComment(Request $req, $id) {
        $logwork = Comment::find($id);
        $logwork->description = $req['description']; // I can type $req->input('description');
        $logwork->save();
        return Redirect::back();
    }

     public function deleteComment(Request $req, $id) {
        $task = Comment::find($id);
        $task->delete();
        return Redirect::back();
     }

     public function addComment(Request $req, $id) {
        $logwork = new Comment();
        $logwork->description = $req['description']; // I can type $req->input('description');
        $logwork->task_id = $id;
        $logwork->user_id = Auth::user()->id;
        $logwork->save();
        return Redirect::back();
    }

    // backup database
    public function backupDB() {
        try {
        Artisan::call('backup:run');
        $errorMsg = '1';
        }catch(Exception $e){
            $errorMsg = 'Caught exception: '.  $e->getMessage();
        }
        return Redirect::back()->with('errorMsg',$errorMsg);
    }
    //Create new task
    public function create_task(Request $req) {
        $task = new Task();
        $task->name = $req['title'];
        $task->description = $req['description'];
        $task->type = $req['type'];
        $task->state = $req['state'];;
        $task->save();
        return Redirect::back();
    }

    //edit Task
    public function editTask(Request $req, $id) {
        $task = Task::find($id);
        $task->description = $req['description']; 
        $task->name = $req['title'];
        $task->state = $req['state'];
        $task->type = $req['type'];
        $task->save();
        return Redirect::back();
    }
    //delete task
    public function deleteTask(Request $req, $id) {
        $task = Task::find($id);
        $task->comment()->delete();
        $task->logwork()->delete();
        DB::table('task_user')->where([['task_id', $id]])->delete();
        $task->delete();
        return Redirect::back();
     }

     public function BuckupPage(){
        
        return view('Buckup');
     }

     public function AddNewUser(){
        
        return view('newUser');
     }
     
     public function CreateNewUser(Request $req){
        try {
            $task = new User();
            $task->name = $req['name'];
            $task->rule = $req['rule'];
            $task->email = $req['email'];
            $task->password = bcrypt($req['password']);
            $task->image = 'null';
            $task->save();
            $errorMsg = '1';
            }catch(Exception $e){
                $errorMsg = 'Caught exception: '.  $e->getMessage();
            }
            return Redirect::back()->with('errorMsg',$errorMsg); 
     }

     public function DeleteUser($id){
        $user = User::find($id);
        $user->logwork()->delete();
        $user->comment()->delete();
        DB::table('task_user')->where([['user_id', $id]])->delete();
        $user->delete();
        return Redirect::back();
     }
}
