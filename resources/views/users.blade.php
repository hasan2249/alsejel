@extends('home')

@section('content2')
<?php echo "....  Hi from <strong>users</strong> page"?>

<table class="table table-hover">
  <thead class="thead-light">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Rule</th>
      <th scope="col">Email</th>
    </tr>
  </thead>
  <tbody>

    @foreach ($users as $user)
      <tr>
        <th scope="row">{{$user->id}}</th>
        <td>{{$user->name}}</td>
        <td><?php if($user->rule == 1) {echo"Admin";} else {echo"User";}?></td>
        <td>{{$user->email}}</td>
      </tr>
    @endforeach

  </tbody>
</table>

@endsection