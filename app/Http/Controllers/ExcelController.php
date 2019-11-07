<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use Excel; // Excel namespace

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\task_user;

class ExcelController extends Controller
{
    //

    public function importExport()
	{
        $users= DB::table('users')->get();
		return view('excel',['users' => $users]);
	}
	public function downloadExcel(Request $request,$type)
	{
        //$data = Task::find(1)->users()->orderBy('name')->get();
        $selected_id=$request->get('user');
        $a=array();                       
        $data = User::find($selected_id);
        foreach ($data->tasks as $task){  
        $d=array();         
        array_push($d,$data->name);
        array_push($d,$task->name);
        array_push($d,$task->created_at);
        $a[]=$d;
    }
        return Excel::create('tasks_log', function($excel) use ($a) {
			$excel->sheet('mySheet', function($sheet) use ($a)
	        {
				    $sheet->fromArray($a);
	        });
		})->download($type);
	}
}
