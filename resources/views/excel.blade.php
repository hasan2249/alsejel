<html lang="en">
<head>
	<title>Import - Export Laravel 5</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" >
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<div class="navbar-brand" >
                        <div class="col-md-12">
                            Import/Export all tasks 
                        </div>
                </div>
			</div>
		</div>
	</nav>
	<div class="container">
            <form method="GET" action="{{ URL::to('downloadExcel/xlsx') }}">
                <select class="btn btn-primary" name="user">
                        <option value="" selected disabled hidden>Select employee name..</option>
                    @foreach($users as $user)
                     <option value="{{ $user->id}}">{{ $user->name}}</option>
                    @endforeach
                </select>
                <button class="btn btn-success">Download Excel xlsx</button>
            </form>
	</div>
</body>
</html>