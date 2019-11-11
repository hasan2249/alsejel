
@extends('home')

@section('content2')
<div>
    <?php echo "....  Hi from <strong>Task</strong> page"?>
    
    <h1>Type of task: {{$task->type}}</h1>
    <br/>
    <h1>Title of task: {{$task->name}}</h1>
    <br/>
    <h1>Created at: {{$task->created_at}}</h1>
    <br/>
    <h1>Description of task: {{$task->description}}</h1>
</div>

<button id="logwork" type="button" class="btn btn-outline-primary">Logwork</button>
<a href="#" id="show_logworks"  class="btn btn-outline-success">Comments</a>
<button type="button" class="btn btn-outline-danger">Activities</button>

{{-- start logwork form --}}
<div id="logwork_form">
<form action="/task/{{$task->id}}" method="POST">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="exampleFormControlSelect1">Date:</label>
          <input name="date" class="form-control" type="date" required>
        </div>
        <div class="form-group">
                <label for="exampleFormControlSelect1">Date:</label>
        </div>
        <div class="form-group">
         <label for="exampleFormControlSelect1">Deuration of time:</label>
         <div class="row">  
        <div class="col-2">
            <input name="houres" type="number"  class="form-control" id="formGroupExampleInput" required>
        </div>
        <div class="col-2">
                <label for="formGroupExampleInput">hours</label>
            </div>
        <div class="col-2">
            <input name="minutes" type="number"  class="form-control" id="formGroupExampleInput" value="0" required>
        </div>
            <div class="col-2">
            <label for="formGroupExampleInput">minutes</label>    
        </div>
        </div>
    </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Description:</label>
            <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>
          </div>
          <button id="save" type="submit" class="btn btn-primary">Save</button>
    </form>
    <div>
        {{-- users commented on the task --}}
        @foreach ($users as $user)
            {{$user->id}}<br/>
            {{$user->name}}<br/>
            {{$user->email}}<br/>
            {{$user->created_at}}<br/>
        @endforeach
        {{-- -------------------------- --}}
<br/><br/><br/><br/>

        {{-- logworks on the task --}}
        @foreach ($logworks as $logwork)
            logwork id: {{$logwork->id}}<br/>
            user id: {{$logwork->user_id}}<br/>
            description: {{$logwork->description}}<br/>
            houres: {{$logwork->houre}}<br/>
            minutes: {{$logwork->minute}}<br/>
            Date: {{$logwork->date}}<br/>
            created_at: {{$logwork->created_at}}<br/><br/>
        @endforeach
        {{-- -------------------------- --}}
    </div>
</div>

@endsection