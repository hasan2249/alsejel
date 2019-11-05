@extends('home')

@section('content2')
<?php echo "....  Hi from <strong>tasks</strong> page"?>

<table class="table table-hover">
  <thead class="thead-light">
    <tr>
      <th scope="col">Type</th>
      <th scope="col">Title</th>
      <th scope="col">Created at</th>
    </tr>
  </thead>
  <tbody>
    
      <tbody>

          @foreach ($tasks as $task)
          <tr>
              <th scope="row">{{$task->type}}</th>
              <td>{{$task->name}}</td>
              <td>{{$task->created_at}}</td>
            </tr>
          @endforeach
      
        </tbody>

  </tbody>
</table>

@endsection