
@extends('home')

@section('content2')
<div>
        <?php echo "....  Hi from <strong>User</strong> page"?>
        
        <h1>Name: {{$user->name}}</h1>
        <h6>Id: {{$user->id}}</h6>
        <h4>Created at: {{$user->created_at}}</h4>
        <h5>Email: {{$user->email}}</h5>
        <h2>Rule: <?php if($user->rule == 1) {echo"Admin";} else {echo"User";}?></h2>
        </div>
@endsection

