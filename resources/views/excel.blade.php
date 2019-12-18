@extends('home')

@section('content2')
    
<style>
  a:hover {
    text-decoration : none;
    
}
</style>

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
    </div>
@endif
	<div class="container">
            <form autocomplete="off" method="GET" action="{{ URL::to('downloadExcel') }}" >
             
            <div class="input-group">
            <div class = "row">  
            <div class="col-md-3">
                <select class="btn btn-primary usr" name="user" id="selUser">
                        <option value="" selected="selected">Select employee name..</option>
                    @foreach($users as $user)
                     <option value="{{ $user->id}}">{{ $user->name}}</option>
                    @endforeach
                </select>
                </div>
                @if ($errors->has('user'))
                	<span class="text-danger">{{ $errors->first('user') }}</span>
            	@endif
             <div class="col-md-3">
                <select class="btn btn-primary tsk" name="task" >
                        <option value="" selected= "disabled hidden"><span class="grey_color">Select task name..</span></option>
                    @foreach($tasks as $task)
                     <option value="{{ $task->id}}" >{{ $task->name}}</option>
                    @endforeach
                </select>
                </div>
            <div class="col-md-3 ">
                <div class="row">
                <div class="col-md-2">
                <label>From</label> 
                </div>
                    <div class="col-md-10">  
                    <input class="form-control" type="text"  id="StartDate" name="start">
                        @if ($errors->has('start'))
                            <span class="text-danger">{{ $errors->first('start') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-3 ">
            <div class="row">
                <div class="col-md-2">
                <label >To</label> 
                </div>
                <div class="col-md-10">   
                <input class="form-control" type="text" id="EndDate" name="end">
                @if ($errors->has('end'))

                	<span class="text-danger">{{ $errors->first('end') }}</span>

            	@endif
                 </div>

                </div>
                </div>
</div>
</div>

                </div>
                <div class="row">
                <div class="col-md-6 offset-md-4">
                <button class=" add-comment-btn btn-success" style="margin-top:100px;">Show & Download Excel xlsx</button>
                </div>
                   </div>
            </div>
            </form>
    </div>
@endsection