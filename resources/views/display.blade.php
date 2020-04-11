@extends('home')

@section('content2')
<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<div class="navbar-brand" >
                        <div class="col-md-12" style=" font-family: Times New Roman">
                            Results
                        </div>
                </div>
			</div>
		</div>
    </nav>
    <div class="row align-items-start">
    <div class="col-md-2 offset-md-0">
            <button  onclick="window.location='{{ URL::to('allToExcel/xlsx') }}'" class="btn btn-save-file btn-primary" >Save as excel file</button>
     </div>
  </div>
            <div class="row">
            <div class=" alert alert-success" role="alert" >
            Total elapsed time : {{$total_hour}} hours, {{$total_minute}} minutes
            </div>
            <table class="table table-hover"  style="overflow: hidden;">
            <thead class="thead-light">
            <tr>
                <th scope="col" style="color:blue ; font-size:20px;font-family: Times New Roman">Employee Name</th>
                <th scope="col" style="color:blue ; font-size:20px;font-family: Times New Roman">Task Name</th>
                <th scope="col" style="color:blue ; font-size:20px;font-family: Times New Roman">Hours</th>
                <th scope="col" style="color:blue ; font-size:20px;font-family: Times New Roman">Minutes</th>
                <th scope="col" style="color:blue ; font-size:20px;font-family: Times New Roman">Date</th>
                <th scope="col" style="color:blue ; font-size:20px;sfont-family: Times New Roman">Description</th>
            </tr>
            </thead>
            <tbody>   
                @foreach ($a as $row)
                <tr>
                    <td>{{ $row[0] }}</td>
                    <td>{{ $row[1] }}</td>
                    <td>{{ $row[2] }}</td>
                    <td>{{ $row[3] }}</td>
                    <td>{{ $row[4] }}</td>
                    <td>{{ $row[5] }}</td>
                </tr> 
                @endforeach
            </tbody>
    </table> 
</div>


    @endsection