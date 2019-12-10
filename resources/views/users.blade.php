@extends('home')

@section('content2')

<p style="text-align:center"> <span style="color:blue ; font-size: 50px ; letter-spacing: 5px;font-family: Times New Roman">SCACE</span> <small
        style="font-size: 25px ;letter-spacing: 3px">team</small></p>
<table class="table table-hover">
    <thead class="thead-light">
        <tr>
            <th scope="col" style="color:blue ; font-size:20px;font-family: Times New Roman"></th>
            <th scope="col" style="color:blue; font-size:20px;font-family: Times New Roman">Name</th>
            <th scope="col" style="color:blue; font-size:20px;font-family: Times New Roman">Rule</th>
            <th scope="col" style="color:blue; font-size:20px;font-family: Times New Roman">Email</th>
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