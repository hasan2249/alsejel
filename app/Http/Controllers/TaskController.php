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
        $task = Array("task" => $tasks ,"comments" =>$comments ,"bool" =>$bool , "total_hours" =>$total_hours , "total_minuts" =>$total_minuts)  ;
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
                'logworks.created_at','logworks.updated_at','logworks.user_id');

        $task_logs_comments = DB::table('tasks')
            ->join('comments', 'comments.task_id', '=','tasks.id')
            ->where('tasks.id','=',$id)
            ->select('comments.id','comments.description',
                DB::raw("NULL As hour"),DB::raw("NULL As minute"),
                'comments.created_at','comments.updated_at','comments.user_id')
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
                            <a href="."/user/".User::find($activity->user_id)->id.">".User::find($activity->user_id)->name."</a> -
                            <span title='Rule: 1' class='subText'><span class='date'>".
                        ( $activity->updated_at > $activity->created_at ?
                            (empty($activity->hour)  && empty($activity->minute)?
                                "Updated his comment at: ". $activity->updated_at."." :
                                "Updated his log  at: ". $activity->updated_at. ", to ".  $activity->hour ." hours and ". $activity->minute ." minutes.") :
                            (empty($activity->hour) && empty($activity->minute)?
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



     public function load_task_logworks_data($id,Request $request)
    {
        $logworks = Logwork::where('task_id', $id)->orderBy('date','desc')->get();
        
        // $logworks = DB::table('logwork')
        // ->where('logwork.id','=',$id)->get()->sortByDesc('updated_at');

        $num_of_records = 10;
        if($request->ajax())
        {
            if($request->date > 0)
            {
                $task_some_logwork = $logworks->where('date', '<', $request->date)->take($num_of_records);
            }
            else
            {
                $task_some_logwork = $logworks->take($num_of_records);
            }
            $output = '';
            $last_date = '';

            if(!$task_some_logwork->isEmpty())
            {
                foreach($task_some_logwork as $logwork)
                {
                    $output .= "
                    <div id='worklog-142295' class='issue-data-block'>
                    <div class='actionContainer'>
                        <div class='action-links'>";

              if(Auth::user()->id == $logwork->user->id){
              $output .="<a href='#' data-toggle='modal' data-target='#EditModal{$logwork->id}' data-whatever='@getbootstrap' title='Edit' class='edit-worklog-trigger' style='margin:5px 5px 5px'><i class='fa fa-edit' aria-hidden='true'></i></a>";
              }
              $output .="<div class='modal fade' id='EditModal{$logwork->id}' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                <div class='modal-dialog' role='document'>
                  <div class='modal-content'>
                    <div class='modal-header'>
                      <h5 class='modal-title' id='exampleModalLabel'>Edit work log</h5>
                      <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                      </button>
                    </div>
                    <div class='modal-body'>
                      <form action='/editLogwork/{$logwork->id}' method='POST'>
                        ". csrf_field() ."
                        <div class='form-group'>
                          <label for='exampleFormControlSelect1' class='col-form-label'>Date:</label>
                          <input name='date' class='form-control' value='{$logwork->date}' type='date' required>
                        </div>
                        <div class='form-group'>
                          <label for='exampleFormControlSelect1' class='col-form-label'>Deuration of time:</label>
                          <div class='row'>
                            <div class='col-2'>
                              <input name='houres' type='number' min='0' value='{$logwork->houre}' class='form-control' id='formGroupExampleInput' required>
                            </div>
                            <div class='col-2'>
                              <label for='formGroupExampleInput' class='col-form-label'>hours </label>
                            </div>
                            <div class='col-2'>
                            </div>
                            <div class='col-2'>
                              <input name='minutes' type='number' min='0' value='{$logwork->minute}' class='form-control' id='formGroupExampleInput' value='0' required>
                            </div>
                            <div class='col-2'>
                              <label for='formGroupExampleInput' class='col-form-label'>minutes</label>
                            </div>
                          </div>
                        </div>
                        <label for='exampleFormControlTextarea1' class='col-form-label'>Description:</label>
                        <div class='form-group'>

                          <textarea name='description' class='form-control' id='exampleFormControlTextarea1' rows='3' required>{$logwork->description}</textarea>
                        </div>
                        <div class='modal-footer'>
                          <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                          <button id='save' type='submit' class='btn btn-primary'>Save</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>";
  
              if(Auth::user()->id == $logwork->user->id)
              {
                $output .="<form id='Delete_logwork_form{$logwork->id}' action='/delete/{$logwork->id}' method='GET'>
                <a href='#' id='delete_worklog_142295' title='Delete' class='delete-worklog-trigger' style='margin:5px 5px 5px'><i data-toggle='modal' data-target='#confirmLogworkDelete{$logwork->id}' class='fa fa-trash' aria-hidden='true'></i></a>
                  </form>";
                 }
   
            $output .="</div>
            <div class='action-details'>
            <a href='/user/{$logwork->user->id}'>{$logwork->user->name}</a>
              logged work - <span title='Created: {$logwork->user->created_at}' class='subText'><span class='date'>{$logwork->date}</span></span> </div>
            <div class='action-body'>
              <ul id='worklog_details_142295' class='item-details'>
                <li>
                  <dl>
                    <dt>Time Spent:</dt>
                    <dd id='wl-142295-d' class='worklog-duration'>{$logwork->houre} hours, {$logwork->minute} minutes</dd>
                  </dl>
                  <dl>
                    <dt>&nbsp;</dt>
                    <dd id='wl-142295-c' class='worklog-comment'>
                      <p>{$logwork->description} </p>
                    </dd>
                  </dl>
                </li>
              </ul>
            </div>
          </div>
        </div>

  <div class='modal fade' id='confirmLogworkDelete{$logwork->id}' tabindex='-1' role='dialog' aria-labelledby='exampleModalLab' aria-hidden='true'>
    <div class='modal-dialog' role='document'>
      <div class='modal-content'>
        <div class='modal-header'>
          <h5 class='modal-title' id='exampleModalLab'>Delete Logwork</h5>
          <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
        <div class='modal-body'>
          You are going to delete the log work, Are you sure?
        </div>
        <div class='modal-footer'>
          <button type='button' class='btn btn-secondary' data-dismiss='modal'>No, Close</button>
          <input type='submit' form='Delete_logwork_form{$logwork->id}' value='Yes, Delete' class='btn btn-primary' />
        </div>
      </div>
    </div>
  </div>
                    ";
                    $last_date = $logwork->date;
                }
                if (!(count($task_some_logwork) < $num_of_records))
                {
                    $output .= '

       <div class="col-md-8 offset-md-4">
       <div id="task_logworks_load_more">
        <button type="button" name="load_more_task_logworks_button" class="btn-link" data-date="'.$last_date.'" id="load_more_task_logworks_button">Load More</button>
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
        DB::table('comments')->where([['task_id', $id]])->delete();
        DB::table('logworks')->where([['task_id', $id]])->delete();
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

     public function DeleteUser(Request $req ,$id){
        $user = User::find($id);
        DB::table('comments')->where([['user_id', $id]])->delete();
        DB::table('logworks')->where([['user_id', $id]])->delete();
        DB::table('task_user')->where([['user_id', $id]])->delete();
        $user->delete();
        return Redirect::back();
     }
}
