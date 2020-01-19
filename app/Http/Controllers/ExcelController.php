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
use App\Logwork;
use Session;
use Redirect;

class ExcelController extends Controller
{
    public function importExport()
	{
        $users= DB::table('users')->get();
        $tasks = DB::table('tasks')->get();
		return view('excel',['users' => $users,'tasks' => $tasks]);
    }

    public function display()
	{
        if(Session::has('download') && Session::has('total_hour') && Session::has('total_minute')){
            $a = Session::get('download');
            $total_hour = Session::get('total_hour');
            $total_minute = Session::get('total_minute');
            return view('display',['a'=>$a , 'total_hour'=>$total_hour, 'total_minute'=>$total_minute]);
        }
    }

    public function allToExcel($type)
    {
        $a = Session::get('download');
        return \Excel::create('tasks_log', function($excel) use ($a) {
			$excel->sheet('mySheet', function($sheet) use ($a)
	        {
                $sheet->cell('A1', function($cell) {$cell->setValue('Employee Name');   });
                $sheet->cell('B1', function($cell) {$cell->setValue('Task Name');   });
                $sheet->cell('C1', function($cell) {$cell->setValue('Hours');   });
                $sheet->cell('D1', function($cell) {$cell->setValue('Minutes');   });
                $sheet->cell('E1', function($cell) {$cell->setValue('Date');   });
                $sheet->cell('F1', function($cell) {$cell->setValue('Description');   });
                if (!empty($a)) {
                    foreach ($a as $key => $value) {
                        $i = $key+2;
                        $sheet->cell('A'.$i, $value[0]); 
                        $sheet->cell('B'.$i, $value[1]); 
                        $sheet->cell('C'.$i, $value[2]); 
                        $sheet->cell('D'.$i, $value[3]); 
                        $sheet->cell('E'.$i, $value[4]); 
                        $sheet->cell('F'.$i, $value[5]); 
                    }
                }
                    $total_hour = Session::get('total_hour');
                    $total_minute = Session::get('total_minute');
                    $i = $i+2;     
                    $sheet->cell('B'.$i, 'Total elapsed time :');
                    $sheet->cell('C'.$i,  $total_hour .' hours, ');  
                    $sheet->cell('D'.$i,  $total_minute .' minutes'); 

	        });
        })->download($type);
    
    }

	public function downloadExcel(Request $request)
	{
        $input = $this->validate($request,['user' => 'required',
        'start' => 'required','end' => 'required'],['user.required' => 'Employee name is required!',
        'start->required'=> 'start date is required ','end->required'=> 'end date is required ']);

        $selected_id = $request->get('user');
        $start_date = $request->input("start");
        $end_date = $request->input("end");
        $data = array();                       
        $user = User::find($selected_id);
        $username=$user->name;
        $total_hour = 0;
        $total_minute = 0;
        if(!$request->get('task'))
        {
            $user_logs = Logwork::where('user_id', $selected_id)->whereBetween('date', [$start_date, $end_date])->get();
        }
        else{
            $user_logs = Logwork::where('user_id', $selected_id)->where('task_id',$request->get('task'))->whereBetween('date', [$start_date, $end_date])->get();
        }

        foreach ($user_logs as $log)
        {  
            $task_name = $log->task->name;

            $hours_duration = $log->houre;
            $total_hour = $total_hour + $hours_duration;

            $minutes_duration = $log->minute;
            $total_minute = $total_minute + $minutes_duration;

            $date= $log->date;
            $description= $log->description;
            

            $d = array();      
            array_push($d,$username);
            array_push($d,$task_name);
            array_push($d,$hours_duration);
            array_push($d,$minutes_duration);
            array_push($d,$date);
            array_push($d,$description);
            $data[]=$d;
            unset($d);
         }

    if(sizeof($data)==0)
    {
         return redirect()->back()->with('alert','No data retrieved between the desired dates!!');
    }
    $total_time = $total_hour + floor($total_minute / 60);
    Session::put('download', $data);
    Session::put('total_hour', $total_time);
    Session::put('total_minute', $total_minute % 60);
    return redirect()->action('ExcelController@display');
    }
}
