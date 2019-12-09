<html lang="en">
<head>
	<title>Import - Export Laravel 5</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" >
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css" rel="stylesheet"/>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.js"></script>
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
            <form method="GET" action="{{ URL::to('downloadExcel/xlsx') }}" >
                <div class="input-group">
                <div class="input-group-addon">
                <select class="btn btn-primary usr" name="user" id="selUser">
                        <option value="" selected="selected">Select employee name..</option>
                    @foreach($users as $user)
                     <option value="{{ $user->id}}">{{ $user->name}}</option>
                    @endforeach
                </select>
                <select class="btn btn-primary tsk" name="task">
                        <option value="" selected disabled hidden><span class="grey_color">Select task name..</span></option>
                    @foreach($tasks as $task)
                     <option value="{{ $task->id}}" >{{ $task->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-group">
            <div class="col-xs-4 ">
                <input class="date form-control " type="text" id="StartDate" name="start">
            </div>
            <div class="col-xs-4 ">
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
                </div>
                <span class="input-group-btn">  
                <button class="btn btn-success">Show & Download Excel xlsx</button>
                </span>
            </div>
            </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.js"></script>
<script>
    $(document).ready(function(){
$(".tsk").select2({ 
    templateResult: formatSingleResult
})
$(".usr").select2({ 
    templateResult: formatSingleResult2
})
        });

function formatSingleResult(result) {
    var term =$(".tsk").data("select2").dropdown.$search.val();
    var reg = new RegExp(term, 'gi');
    var optionText = result.text;
    var boldTermText = optionText.replace(reg, function(optionText) {return `<b>${optionText}</b>`});
    var $item = $(`<span> ${boldTermText}  </span>`);
    return $item;
}
function formatSingleResult2(result) {
    var term =$(".usr").data("select2").dropdown.$search.val();
    var reg = new RegExp(term, 'gi');
    var optionText = result.text;
    var boldTermText = optionText.replace(reg, function(optionText) {return `<b>${optionText}</b>`});
    var $item = $(`<span> ${boldTermText}  </span>`);
    return $item;
}
</script>
</body>
</html>