@extends('home')

@section('content2')
<p style="text-align:center"> <span style="color:blue ; font-size: 50px ; letter-spacing: 5px;font-family: Times New Roman">SCASE</span> <small style="font-size: 25px ;letter-spacing: 3px; font-family: Times New Roman">tasks</small></p>

<div class="col-3 py-1">
@if(Auth::user()->rule == "1")
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Create New Task</button>
    @endif
    <br>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
        <div class="modal-dialog" role="document" >
            <div class="modal-content" style = "width:600px;" >
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/tasks" method="POST">
                        {{ csrf_field() }}
                        <label for="exampleFormControlTextarea1" class="col-form-label">Title:</label>
                        <div class="form-group">
                            <textarea name="title" class="form-control" id="exampleFormControlTextarea1" rows="1" required></textarea>
                        </div>
                        <label for="exampleFormControlTextarea1" class="col-form-label">Description:</label>
                        <div class="form-group">
                            <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>
                        </div>
                        <label for="exampleFormControlTextarea1" class="col-form-label">Type:</label>
                        <div class="form-check-inline">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="type" value="Intenta project">Intenta project
                            </label>
                        </div>
                        </div>
                        <div class="form-check-inline">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="type" value="Internal project">Internal project
                            </label>
                        </div>
                        </div>
                        <div class="form-check-inline">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="type" value="Training"> Training
                            </label>
                        </div>
                        </div>

                        <label for="exampleFormControlTextarea1" class="col-form-label" style ="margin-top:20px">State:</label>
                        <div class="form-check-inline">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="state" value="To Do">To Do
                            </label>
                        </div>
                        </div>
                        <div class="form-check-inline">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="state" value="In Progress">In Progress
                            </label>
                        </div>
                        </div>
                        <div class="form-check-inline">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="state" value="Done">Done
                            </label>
                        </div>
                        </div>
                        <div class="form-check-inline">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="state" value="Disabled">Disabled
                            </label>
                        </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button id="save" type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<table class="table table-hover" >
    <thead class="thead-light">
        <tr>
            <th scope="col" style="color:blue ; font-size:20px;font-family: Times New Roman">Type</th>
            <th scope="col" style="color:blue ; font-size:20px;font-family: Times New Roman">Title</th>
            <th scope="col" style="color:blue ; font-size:20px;font-family: Times New Roman">State</th>
            <th scope="col" style="color:blue ; font-size:20px;font-family: Times New Roman">Created at</th>
            {{-- <th scope="col">Description</th> --}}
        </tr>
    </thead>

    <tbody>

        @foreach ($tasks as $task)
        <tr >
            <th scope="row" class="pointer" onclick="window.location='task/{{$task->id}}';">{{$task->type}}</th>
            <td class="pointer" onclick="window.location='task/{{$task->id}}';" >  {{$task->state}}</td>
            <td class="pointer" onclick="window.location='task/{{$task->id}}';"> {{$task->name}}</td>
            <td class="pointer" onclick="window.location='task/{{$task->id}}';">{{$task->created_at}}</td>
            <td>
            @if(Auth::user()->rule == "1")
            <a href="#" data-toggle="modal" data-target="#EditModalTasks{{$task->id}}" data-whatever="@getbootstrap" title="Edit" class="edit-worklog-trigger" style="margin:5px 5px 5px"><i class="fa fa-edit" aria-hidden="true"></i></a> 
                <form id="Delete_Task_form" action="/deleteTask/{{$task->id}}" method="GET">
                <a href="#" id="delete_task_142295" title="Delete" class="delete-task-trigger" style="margin:5px 5px 5px"><i data-toggle="modal" data-target="#confirmTaskDelete" class="fa fa-trash" aria-hidden="true"></i></a>
              </form>  
              @endif
            </td>

            {{--Edit Task--}}
        <div class="modal fade" id="EditModalTasks{{$task->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
        <div class="modal-dialog" role="document" >
            <div class="modal-content" style = "width:600px;" >
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/editTask/{{$task->id}}" method="POST">
                        {{ csrf_field() }}
                        <label for="exampleFormControlTextarea1" class="col-form-label"  >Title:</label>
                        <div class="form-group">
                            <textarea name="title" class="form-control" id="exampleFormControlTextarea1" rows="1"  required> {{$task->name}}</textarea>
                        </div>
                        <label for="exampleFormControlTextarea1" class="col-form-label">Description:</label>
                        <div class="form-group">
                            <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3" required>{{$task->description}}</textarea>
                        </div>
                        <label for="exampleFormControlTextarea1" class="col-form-label">Type:</label>
                        <div class="form-check-inline">
                        <div class="form-check">
                            <label class="form-check-label">
                            @if ( $task->type == "Intenta project")
                                <input type="radio" class="form-check-input" name="type" value="Intenta project"checked>Intenta project
                                @else
                                <input type="radio" class="form-check-input" name="type" value="Intenta project" >Intenta project
                            @endif
                            </label>
                        </div>
                        </div>
                        <div class="form-check-inline">
                        <div class="form-check">
                            <label class="form-check-label">
                            @if ( $task->type == "Internal project")
                                <input type="radio" class="form-check-input" name="type" value="Internal project" checked>Internal project
                                @else
                                <input type="radio" class="form-check-input" name="type" value="Internal project">Internal project
                                @endif
                            </label>
                        </div>
                        </div>
                        <div class="form-check-inline">
                        <div class="form-check">
                            <label class="form-check-label">
                            @if ( $task->type == "Training")
                                <input type="radio" class="form-check-input" name="type" value="Training" checked> Training
                                @else
                                <input type="radio" class="form-check-input" name="type" value="Training"> Training
                                @endif
                            </label>
                        </div>
                        </div>

                        <label for="exampleFormControlTextarea1" class="col-form-label" style ="margin-top:20px">State:</label>
                        <div class="form-check-inline">
                        <div class="form-check">
                            <label class="form-check-label">
                            @if ( $task->state == "To Do")
                                <input type="radio" class="form-check-input" name="state" value="To Do" checked>To Do
                                @else
                                <input type="radio" class="form-check-input" name="state" value="To Do">To Do
                                @endif
                            </label>
                        </div>
                        </div>
                        <div class="form-check-inline">
                        <div class="form-check">
                            <label class="form-check-label">
                            @if ( $task->state == "In Progress")
                                <input type="radio" class="form-check-input" name="state" value="In Progress" checked>In Progress
                                @else
                                <input type="radio" class="form-check-input" name="state" value="In Progress">In Progress
                                @endif
                            </label>
                        </div>
                        </div>
                        <div class="form-check-inline">
                        <div class="form-check">
                            <label class="form-check-label">
                            @if ( $task->state == "Done")
                                <input type="radio" class="form-check-input" name="state" value="Done" checked>Done
                                @else
                                <input type="radio" class="form-check-input" name="state" value="Done">Done
                                @endif
                            </label>
                        </div>
                        </div>
                        <div class="form-check-inline">
                        <div class="form-check">
                            <label class="form-check-label">
                            @if ( $task->state == "Disabled")
                                <input type="radio" class="form-check-input" name="state" value="Disabled" checked>Disabled
                                @else
                                <input type="radio" class="form-check-input" name="state" value="Disabled">Disabled
                                @endif
                            </label>
                        </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button id="save" type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- end Edit Task--}}

     <!--Start confirm the delete logwork form-->
  <div class="modal fade" id="confirmTaskDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLab" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLab">Delete Task</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          You are going to delete the Task with all the activites, Work logs and Comments related to it , Are you sure?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Close</button>
          <input type="submit" form="Delete_Task_form" value="Yes, Delete" class="btn btn-primary" />
        </div>
      </div>
    </div>
  </div>
  <!--End confirm the delete form-->
        </tr>
        @endforeach
        
    </tbody>

</table>
@endsection
