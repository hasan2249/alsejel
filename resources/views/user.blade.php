
@extends('home')

@section('content2')
<div>
        <?php echo "....  Hi from <strong>User</strong> page"?>
        
        <h1>Name: {{$user->name}}</h1><br/>
        <h1>Id: {{$user->id}}</h1><br/>
        <h1>Created at: {{$user->created_at}}</h1><br/>
        </div>
@endsection

