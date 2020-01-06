
@extends('home')

@section('content2')  

<h1>SCASE graphical information:</h1>

<div class="row marg">

    <div class="col col-md-12">
      <p class="lead"> Work log estimated by [minutes] on specific task between two different date:</p>
    </div>
    
    <div class="col col-md-12" >

      <form class="form-inline" method="post" action="{{url('/charts')}}">
      {{ csrf_field() }}
        <label class="mr-sm-2" for="inlineFormCustomSelect">Chose task</label>  
        <div class="form-check mb-2 mr-sm-2 mb-sm-0">
          <label class="form-check-label">
          <select class="btn btn-primary tsk" placeholder="Select task name.." name="task_id" >
                @foreach($tasks as $task)
                  <option value="{{ $task->id}}"<?php if($task->id == Session::get('task_id')) echo 'selected="selected"'?> >{{ $task->name}}</option>
                @endforeach
           </select>
            <div class="form-check mb-1 mr-sm-1 mb-sm-0">
              <label>From: </label>
                <input class="form-control" type="text" value="{{ Session::get('start_date') }}" id="StartDate" name="start_date">
            </div>
            <div class="form-check mb-1 mr-sm-1 mb-sm-0">
            <label>To: </label>
               <input class="form-control" type="text" value="{{ Session::get('end_date') }}" id="EndDate" name="end_date">
            </div>
          </label>
        </div>
        <button type="submit" class="btn btn-primary">Plot</button>
      </form>
    </div>
  <div class="col col-md-10">

  <div name="plot_chart">
    @if($usersChart)
        {!!$usersChart->container()!!} 
    @endif
  </div>

  </div>

</div>

@if($usersChart)
{!! $usersChart->script() !!}
@endif
@endsection