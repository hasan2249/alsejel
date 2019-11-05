<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TaskController extends Controller
{
    //

    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    ////////////////////////////////////////////////////////
    // Testing purposes
    /////////////

    // this function only for test the tasks page
    public function tasks_page() {
        $tasks = Task::all();
        $task = Array("tasks" => $tasks);
        return view('/tasks',$task);
    }

    /////////////////////////////////////////////////////////

}
