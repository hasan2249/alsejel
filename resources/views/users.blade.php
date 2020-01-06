@extends('home')

@section('content2')

<p style="text-align:center"> <span style="color:blue ; font-size: 50px ; letter-spacing: 5px;font-family: Times New Roman">SCACE</span> <small
        style="font-size: 25px ;letter-spacing: 3px">team</small></p>

    @if(Auth::user()->rule == "1")
     <a href="{{ url('/newUser') }}" class="btn btn-primary" >Create new user</a>
    @endif

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
        <tr>
            <th scope="row" class="pointer" onclick="window.location='user/{{$user->id}}';">{{$user->id}}</th>
            <td class="pointer" onclick="window.location='user/{{$user->id}}';">{{$user->name}}</td>
            <td class="pointer" onclick="window.location='user/{{$user->id}}';"><?php if($user->rule == 1) {echo"Admin";} else {echo"User";}?></td>
            <td class="pointer" onclick="window.location='user/{{$user->id}}';">{{$user->email}}</td>
            <td>
            @if(Auth::user()->rule == "1")
                <form id="Delete_User_form" action="/deleteUser/{{$user->id}}" method="GET">
                <a href="#" id="delete_User" title="Delete" class="delete-task-trigger" style="margin:5px 5px 5px"><i data-toggle="modal" data-target="#confirmUserDelete" class="fa fa-trash" aria-hidden="true"></i></a>
              </form>  
              @endif
            </td>
        </tr>
        @endforeach

    </tbody>
</table>


<!--Start confirm the delete logwork form-->
<div class="modal fade" id="confirmUserDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLab" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLab">Delete User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          You are going to delete the User with his/her activites, Work logs and Comments related to, Are you sure?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Close</button>
          <input type="submit" form="Delete_User_form" value="Yes, Delete" class="btn btn-primary" />
        </div>
      </div>
    </div>
  </div>
  <!--End confirm the delete form-->

@endsection