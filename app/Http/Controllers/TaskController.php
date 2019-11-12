<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request ;

use App\Task;
use App\Logwork;
use App\User;
use Redirect;
use Auth;

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
        $task = Array("task" => $tasks, "logworks" =>$logworks);
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
     //----------------------------------------------------
}
