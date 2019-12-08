<html lang="en">
<head>
	<title>Import - Export Laravel 5</title>
    <link rel="stylesheet" href="select2.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" >
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body>
    	<nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <div class="navbar-brand" >
                                <div class="col-md-12">
                                    RESULTS
                                </div>
                        </div>
                    </div>
                </div>
            </nav>
       <table class="table table-striped">
            @if(sizeof($a[0])==4)
            <thead class="thead-dark">
            <tr>
                    <th scope="col">Emplyee Name</th>
                    <th scope="col">Task Name</th>
                    <th scope="col">Duration</th>
                    <th scope="col">Description</th>
            </tr>
            @else  
            <tr>
                    <th scope="col">Emplyee Name</th>
                    <th scope="col">Duration</th>
                    <th scope="col">Description</th>
             </tr>
            @endif
            </thead>
            <tbody>   
       @foreach ($a as $row)
       @if(sizeof($row)==4)
       <tr>
           <td>{{ $row[0] }}</td>
           <td>{{ $row[1]}}</td>
           <td>{{ $row[2] }}</td>
           <td>{{ $row[3] }}</td>
       </tr>
       @else  
       <tr>
            <td>{{ $row[0] }}</td>
            <td>{{ $row[1]}}</td>
            <td>{{ $row[2] }}</td>
        </tr>
       @endif   
       @endforeach
            </tbody>
    </table> 
 
    <button type="button" onclick="window.location='{{ URL::to('allToExcel/'.serialize($a).'/xlsx') }}'">save file</button>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>