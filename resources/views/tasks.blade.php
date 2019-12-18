@extends('home')

@section('content2')
<p style="text-align:center"> <span style="color:blue ; font-size: 50px ; letter-spacing: 5px;font-family: Times New Roman">SCACE</span> <small style="font-size: 25px ;letter-spacing: 3px">tasks</small></p>

<div class="col-3 py-1">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Create New Task</button>
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
<table class="table table-hover">
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
        <tr onclick="window.location='task/{{$task->id}}';">
            <th scope="row" class="pointer">{{$task->type}}</th>
            <td class="pointer"> {{$task->state}}</td>
            <td class="pointer"> {{$task->name}}</td>
            <td class="pointer">{{$task->created_at}}</td>
            {{-- <td>{{$task->description}}</td> --}}
        </tr>
        @endforeach

    </tbody>

</table>



@endsection