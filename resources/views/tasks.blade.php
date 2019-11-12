@extends('home')

@section('content2')
<?php echo "....  Hi from <strong>tasks</strong> page"?>

<table class="table table-hover">
  <thead class="thead-light">
    <tr>
      <th scope="col">Type</th>
      <th scope="col">Title</th>
      <th scope="col">Created at</th>
      {{-- <th scope="col">Description</th> --}}
    </tr>
  </thead>
  <tbody>
    
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

  </tbody>
</table>

@endsection