
@extends('home')

@section('content2')
<div>
        <?php echo "....  Hi from <strong>User</strong> page"?>
        
        <h1>{{$user->name}}</h1>
        <h6>{{$user->id}}</h6>
        <h4>{{$user->created_at}}</h4>
        <h5>{{$user->email}}</h5>
        <h2><?php if($user->rule == 1) {echo"Admin";} else {echo"User";}?></h2>
        </div>
@endsection

