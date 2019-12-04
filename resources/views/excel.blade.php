<html lang="en">
<head>
	<title>Import - Export Laravel 5</title>
    <link rel="stylesheet" href="select2.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" >
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<div class="navbar-brand" >
                        <div class="col-md-12">
                            Export pivot to excel.
                        </div>
                </div>
			</div>
		</div>
    </nav>
    @if (\Session::has('alert'))
    <div class="alert alert-warning alert-dismissible"  role="alert">
        <span type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
        </span>
        
        {!! \Session::get('alert') !!}
    </div>
@endif
	<div class="container">
            <form method="GET" action="{{ URL::to('downloadExcel/xlsx') }}">
                <div class="input-group">
                <span class="input-group-btn ">
                <select class="btn btn-primary " name="user" id='selUser'>
                        <option value="" selected disabled hidden>Select employee name..</option>
                    @foreach($users as $user)
                     <option value="{{ $user->id}}">{{ $user->name}}</option>
                    @endforeach
                </select>
                <select class="btn btn-primary" name="task">
                        <option value="" selected disabled hidden>Select task name..</option>
                    @foreach($tasks as $task)
                     <option value="{{ $task->id}}">{{ $task->name}}</option>
                    @endforeach
                </select>
            </span>
            <div class="col-xs-2 ">
                <input class="date form-control " type="text" id="StartDate" name="start">
            </div>
            <div class="col-xs-2 ">
                    <input class="date form-control" type="text" id="EndDate" name="end">
                </div>
                <script type="text/javascript">
                    $('.date').datepicker({  
                       format: 'yyyy-mm-dd'
                     });  
                </script>
                <script>
                    $("#StartDate").datepicker().datepicker("setDate", new Date());
                    $("#EndDate").datepicker().datepicker("setDate", new Date());
                </script>  
                <span class="input-group-btn col-xs-2">
                <button class="btn btn-success">Show & Download Excel xlsx</button>
                </span>
            </div>
            </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="select2.min.js"></script>
<script>
    $(document).ready(function(){
$("#selUser").select2();
});
</script>
</body>
</html>