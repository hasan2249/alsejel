@extends('home')

@section('content2')
        
<div class="container">
    <div class="row">
        <div class="col-lg-12 order-lg-2">
        @if (session('error'))
               <div class="alert alert-danger">
                {{ session('error') }}
                </div>
		@endif
            <!--Navigation bar-->
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="" data-target="#Summery" data-toggle="tab" class="nav-link active"
                        id="summery_tab">Summary</a>
                </li>
                <li class="nav-item">
                    <a href="" data-target="#Tasks" data-toggle="tab" class="nav-link"
                        onclick="removeActiveClass('summery_tab')">Tasks</a>
                </li>
                <li class="nav-item">
                    <a href="" data-target="#Activities" data-toggle="tab" class="nav-link"
                        onclick="removeActiveClass('summery_tab')">Activities</a>
                </li>


                @if(Auth::user()->id == $users->id)
                <li class="nav-item">
                    <a href="" data-target="#edit" data-toggle="tab" class="nav-link"
                        onclick="removeActiveClass('summery_tab')">Edit</a>
                </li>
                @endif
            </ul>
        
            
            <!-- <button id="myWish" > click yo fade in</button> -->
            <!--Summery content-->
            <div class="tab-content py-4">
                <div class="tab-pane active" id="Summery">
                    <h5 class="mb-3">User Profile</h5>
                    <div class="display-avatar animated-avatar">
                @if ( $users->image == "null")
                    <img class="profile-img img-lg rounded-circle" src="{{asset('/images/person-icon-male-user-profile-avatar-vector-18833568.jpg')}}"
                        alt="profile image">
                @else
                <img class="profile-img img-lg rounded-circle" src="/images/{{$users->image}}"
                        alt="profile image">
                @endif
                </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="display-income">About</h6>
                            <p style ="margin-top:20px ; margin-bottom:20px "> Software Engineer</p>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-sm table-hover table-striped">
                                <tbody>
                                    <tr>
                                        <td>
                                            <strong>Name:</strong> {{$users->name}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Email:</strong> {{$users->email}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Created at:</strong> {{$users->created_at}}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!--Tasks content-->
                <div class="tab-pane" id="Tasks" onclick="removeActiveClass('Summery')">

                <div class="table-responsive">

                        <table id="Tasks_table" class="table table-hover">
                            <tr>
                                <th>Task Name</th>
                                <th>Task Type</th>
                                <th>State</th>
                                <th>Description</th>   
                            </tr>
                            @foreach($users->tasks as $task)
                            <tr class="pointer" onclick="window.location='/task/{{$task->id}}';">
                                <td>{{$task->name}}</td>
                                <td>{{$task->type}}</td>
                                <td>{{$task->state}}</td>
                                <td><div style="white-space: nowrap; width:300px;
                                  overflow: hidden;
                                text-overflow: ellipsis;">
                                {{$task->description}}</div></td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>

                <!--Activities content-->
                <div class="tab-pane" id="Activities" onclick="removeActiveClass('Summery')">
                <div class="action-details">
                        {{ csrf_field() }}
                        <div id="post_user_activities">

                        </div>
                </div>
                </div>
                <!--End activities content-->
                
                
                @if(Auth::user()->id == $users->id)
        <!-- Start Edit content-->
                <div class="tab-pane" id="edit" onclick="removeActiveClass('Summery')">
                <form method="POST" action="{{ route('change.password') }}"   oninput='new_confirm_password.setCustomValidity(new_confirm_password.value != new_password.value ? "Passwords do not match." : "")'>
                   
                {{ csrf_field() }}
                    <div  class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Current Password</label>
  
                            <div class="col-md-6">
                                <input id="current_password" type="password" class="form-control" name="current_password" autocomplete="current-password" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>
  
                            <div class="col-md-6">
                                <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password" required >
                            </div>
                        </div>
  
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">New Confirm Password</label>
    
                            <div class="col-md-6">
                                <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password" required >
                            </div>
                        </div>
   
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update Password
                                </button>
                            </div>
                        </div>
                    </form>
                    <hr size="pixels" style="height:30px" />
                   
                    <form method="POST" action="{{ route('change.image') }}" enctype="multipart/form-data" id="update-image">
                    {{ csrf_field() }}
                        <div class="form-group row">
                            <label for="exampleFormControlFile1" class="col-md-4 col-form-label text-md-right" >New Profile Picture</label>
    
                            <div class="col-md-6">
                            <input type="file" class="form-control-file"  name="image" accept="image/jpeg/png/jpg" required>
                            </div>
                            @if ($errors->has('image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                        </div>
   
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update Profile picture
                                </button>
                            </div>
                        </div>
                        
                    </form>
                </div>
                @endif  <!--  if this page is his page -->
            </div> 
        </div>
    </div>
    
    <script>
 
 $(document).ready(function () {
$("#update-image").fadeOut();
});
</script>
    <script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }
    </script>
    @endsection