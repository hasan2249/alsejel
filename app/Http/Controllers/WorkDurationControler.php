<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\WorkDuration;
use App\User;
use App\Task;
use Session;

class WorkDurationControler extends Controller
{
    public $users;
    public $tasks;
    public $usersChart;
    
    // this functions are only avilable for authenticated users.
    public function __construct()
    {
        $this->middleware('auth');
        $this->users= User::all();
        $this->tasks = Task::all();
        $this->usersChart = new WorkDuration;
        $this->usersChart->labels(['first', 'second']);
        $this->usersChart->dataset('work log', 'line',  [1,1]);
    }

    public function showChartPage()
    { 
        return view('charts', [ 'usersChart' => $this->usersChart,'users' => $this->users,'tasks' => $this->tasks ] );
    }
    // public function chartOfusersCountChanging()
    // {
    //     $usersChart = new WorkDuration;
    //     $usersChart->labels(['2000s', '1990s', '1980s']);
    //     $today_users = User::whereBetween('created_at', ['2000-1-1','2019-1-1'])->count();
    //     $yesterday_users = User::whereBetween('created_at', ['1990-1-1', '2000-1-1'])->count();
    //     $users_2_days_ago = User::whereBetween('created_at', ['1980-1-1', '1990-1-1'])->count();
    //     $usersChart->dataset('User count', 'line', [$users_2_days_ago, $yesterday_users, $today_users]);
    //     return view('charts', [ 'usersChart' => $usersChart ] );
    // }

    public function chartOfTask(Request $request)
    {
        $updated_at = array();
        $minutes = array();
        $id = $request->input('task_id');
        // foreach($id as $sub_id)

        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        Session::put('task_id',$id);
        Session::put('start_date',$start_date);
        Session::put('end_date',$end_date);

        if($id != 0)
        {
            $task = Task::find($id);
            foreach($task->logwork as $logworks)
            {
                if($logworks->created_at > $start_date && $logworks->created_at < $end_date){
                    $updated_at[] = $logworks->created_at;
                    $minutes[] = $logworks->houre * 60 + $logworks->minute;
                }    
            }
        }else{
            $task = Task::all();
        }
        $myArray = array_map('strval',$updated_at); // Convert each item of array to string.
        // $this->usersChart ;
        unset($this->usersChart);
        $this->usersChart = new WorkDuration;
        $this->usersChart->labels($myArray);
        $this->usersChart->dataset('work log', 'line',  $minutes)
        ->color("rgb(68, 75, 250)")
        ->backgroundcolor("rgb(68, 75, 250,20%)");
        // ->color("rgb(255, 99, 132)")
        //     ->backgroundcolor("rgb(255, 99, 132)")
        //     ->fill(false)
        //     ->linetension(0.1)
        //     ->dashed([5]);
        //return redirect()->action('WorkDurationControler@showChartPage')->with([ 'usersChart' => $this->usersChart, 'users' => $this->users,'tasks' => $this->tasks ])->withInput();
        // return view('charts', [ 'usersChart' => $usersChart, 'users' => $this->users,'tasks' => $this->tasks ] )->withInput();
        return $this->showChartPage();
    }
}
