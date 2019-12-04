<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request ;

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
        $tasks = Task::all();
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
        $task = Array("task" => $tasks, "logworks" =>$logworks ,"comments" =>$comments ,"bool" =>$bool)  ;
        return view('/task',$task);
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

    public function editComment(Request $req, $id) {
        $logwork = Comment::find($id);
        $logwork->description = $req['description']; // I can type $req->input('description');
        $logwork->save();
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

     public function deleteLogwork(Request $req, $id) {
        $task = Logwork::find($id);
        $task->delete();
        return Redirect::back();
     }

     public function deleteComment(Request $req, $id) {
        $task = Comment::find($id);
        $task->delete();
        return Redirect::back();
     }

}
