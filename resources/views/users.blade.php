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
    <tr onclick="window.location='user/{{$user->id}}';">
        <th scope="row" class="pointer">{{$user->id}}</th>
        <td class="pointer">{{$user->name}}</td>
        <td class="pointer"><?php if($user->rule == 1) {echo"Admin";} else {echo"User";}?></td>
        <td class="pointer">{{$user->email}}</td>
      </tr>
    @endforeach

  </tbody>
</table>

@endsection