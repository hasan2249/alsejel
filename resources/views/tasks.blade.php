@extends('home')

@section('content2')
<p style="text-align:center"> <span style="color:blue ; font-size: 50px ; letter-spacing: 5px;font-family: Times New Roman">SCACE</span> <small
        style="font-size: 25px ;letter-spacing: 3px">tasks</small></p>

<table class="table table-hover">
    <thead class="thead-light">
        <tr>
            <th scope="col" style="color:blue ; font-size:20px;font-family: Times New Roman">Type</th>
            <th scope="col" style="color:blue ; font-size:20px;font-family: Times New Roman">Title</th>
            <th scope="col" style="color:blue ; font-size:20px;font-family: Times New Roman">Created at</th>
            {{-- <th scope="col">Description</th> --}}
        </tr>
    </thead>

    <tbody>

        @foreach ($tasks as $task)
        <tr onclick="window.location='task/{{$task->id}}';">
            <th scope="row" class="pointer">{{$task->type}}</th>
            <td class="pointer"> {{$task->name}}</td>
            <td class="pointer">{{$task->created_at}}</td>
            {{-- <td>{{$task->description}}</td> --}}
        </tr>
        @endforeach

    </tbody>

</table>



@endsection