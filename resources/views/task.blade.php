
@extends('home')

@section('content2')
<div>
    <?php echo "....  Hi from <strong>Task</strong> page"?>
    {{-- start logwork form --}}
    <h3><b>Type of task:</b> {{$task->type}}</h3>
    <br/>
    <h3><b>Title of task:</b> {{$task->name}}</h3>
    <br/>
    <h3><b>Created at:</b> {{$task->created_at}}</h3>
    <br/>
    <h3><b>Description of task:</b> {{$task->description}}</h3>
    <h3><b>Assigned to:</b></h3>
    @foreach($task->user as $user)
    <ul>
    <li><h3> {{$user->name}}</h3></li>
    </ul>
    @endforeach
    {{------------------------------}}
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
{{-----------------------------}}
        {{-- logworks on the task --}}
        @foreach ($logworks as $logwork)
            logwork id: {{$logwork->id}}<br/>
            description: {{$logwork->description}}<br/>
            User id: <b>{{$logwork->user->id}}</b><br/>
            User name: <b>{{$logwork->user->name}}</b><br/>
            User email: <b>{{$logwork->user->email}}</b><br/>
            User created_at: <b>{{$logwork->user->created_at}}</b><br/>
            houres: {{$logwork->houre}}<br/>
            minutes: {{$logwork->minute}}<br/>
            Date: {{$logwork->date}}<br/>
            created_at: {{$logwork->created_at}}<br/>
            <hr/>
            
        @endforeach
        {{------------------------------}}
    </div>
</div>

@endsection