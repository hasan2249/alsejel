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
use Session;
use Redirect;
class ExcelController extends Controller
{
    //

    public function importExport()
	{
        $users= DB::table('users')->get();
        $tasks = DB::table('tasks')->get();
		return view('excel',['users' => $users,'tasks' => $tasks]);
    }
    public function display()
	{
        if(Session::has('download')){
            $a = Session::get('download');
            return view('display',['a'=>$a]);
        }
    }
    public function allToExcel($arr,$type )
    {
        $a=unserialize($arr);;
        //$type = $request->get('type');
        return \Excel::create('tasks_log', function($excel) use ($a) {
			$excel->sheet('mySheet', function($sheet) use ($a)
	        {
                $cols = count($a[0]);
                if($cols==4){
                $sheet->cell('A1', function($cell) {$cell->setValue('Emplyee Name');   });
                $sheet->cell('B1', function($cell) {$cell->setValue('Task Name');   });
                $sheet->cell('C1', function($cell) {$cell->setValue('Duration');   });
                $sheet->cell('D1', function($cell) {$cell->setValue('Description');   });
                if (!empty($a)) {
                    foreach ($a as $key => $value) {
                        $i= $key+2;
                        $sheet->cell('A'.$i, $value[0]); 
                        $sheet->cell('B'.$i, $value[1]); 
                        $sheet->cell('C'.$i, $value[2]); 
                        $sheet->cell('D'.$i, $value[3]); 
                    }
                }
            }
            else{
                $sheet->cell('A1', function($cell) {$cell->setValue('Emplyee Name');   });
                $sheet->cell('B1', function($cell) {$cell->setValue('Duration');   });
                $sheet->cell('C1', function($cell) {$cell->setValue('Description');   });
                if (!empty($a)) {
                    foreach ($a as $key => $value) {
                        $i= $key+2;
                        $sheet->cell('A'.$i, $value[0]); 
                        $sheet->cell('B'.$i, $value[1]); 
                        $sheet->cell('C'.$i, $value[2]); 
                    }
                }
            }
	        });
        })->download($type);
    
    }
	public function downloadExcel(Request $request,$type)
	{
        $selected_id=$request->get('user');
        $start_date = $request->input("start","");
        $end_date = $request->input("end","");
        $a=array();                       
        $data = User::find($selected_id);
        $username=$data->name;
            if(!$request->get('task'))
            {
                $user_logs = DB::table('logworks')->where('user_id', $selected_id)->whereBetween('created_at', [$start_date, $end_date])->get();
            }
            else{
                $user_logs = DB::table('logworks')->where('user_id', $selected_id)->where('task_id',$request->get('task'))->whereBetween('created_at', [$start_date, $end_date])->get();
            }
        foreach ($user_logs as $log){  
        if($request->get('task'))
        {
            $ts = Task::find($request->get('task'));
            $task_name = $ts->name;
            $duration = $log->work_duration;
            $description= $log->description;
        }
        else{
            $duration = $log->work_duration;
            $description= $log->description;
        }
        $d=array();      
        array_push($d,$username);
        if($request->get('task'))
        {
        array_push($d,$task_name);
        }
        array_push($d,$duration);
        array_push($d,$description);
        $a[]=$d;
        unset($d);
    }
    if(sizeof($a)==0)
    {
         return redirect()->back()->with('alert','No data retrieved between the desired dates!!');
    }
    Session::flash('download', $a);
    return redirect()->action('ExcelController@display');
    }
}
