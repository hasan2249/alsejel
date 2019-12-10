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
            <div class="row">
       <table class="table table-hover">
            @if(sizeof($a[0])==5)
            <thead class="thead-light">
            <tr>
                    <th scope="col" style="color:blue ; font-size:20px;font-family: Times New Roman">Employee Name</th>
                    <th scope="col" style="color:blue ; font-size:20px;font-family: Times New Roman">Task Name</th>
                    <th scope="col" style="color:blue ; font-size:20px;font-family: Times New Roman">Duration(hours)</th>
                    <th scope="col" style="color:blue ; font-size:20px;font-family: Times New Roman">Duration(minutes)</th>
                    <th scope="col" style="color:blue ; font-size:20px;sfont-family: Times New Roman">Description</th>
            </tr>
            @else  
            <tr>
                    <th scope="col">Employee Name</th>
                    <th scope="col">Duration(hours)</th>
                    <th scope="col">Duration(minutes)</th>
                    <th scope="col">Description</th>
             </tr>
            @endif
            </thead>
            <tbody>   
       @foreach ($a as $row)
       @if(sizeof($row)==5)
       <tr>
           <td>{{ $row[0] }}</td>
           <td>{{ $row[1]}}</td>
           <td>{{ $row[2] }}</td>
           <td>{{ $row[3] }}</td>
           <td>{{ $row[4] }}</td>
       </tr>
       @else  
       <tr>
            <td>{{ $row[0] }}</td>
            <td>{{ $row[1]}}</td>
            <td>{{ $row[2] }}</td>
            <td>{{ $row[3] }}</td>
        </tr>
       @endif   
       @endforeach
            </tbody>
    </table> 
</div>
<div class="row">
    <div class="col-md-6 offset-md-4">
                <button  onclick="window.location='{{ URL::to('allToExcel/'.serialize($a).'/xlsx') }}'" class="btn btn-primary" style="margin-top:50px; width:100x;font-family: Times New Roman">Save File</button>
     </div>
  </div>

    @endsection