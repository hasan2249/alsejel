@extends('home')

@section('content2')
<div class="container">
    <div class="row">
        <div class="col-lg-12 order-lg-2">

            <!--Navigation bar-->
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="" data-target="#Summery" data-toggle="tab" class="nav-link active"
                        id="summery_tab">Summery</a>
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
                @if(Auth::user()->rule == "1")
                <li class="nav-item">
                    <a href="" data-target="#Backup" data-toggle="tab" class="nav-link"
                        onclick="removeActiveClass('summery_tab')">Backup</a>
                </li>
                @endif
                @endif
            </ul>
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif 
            
            @if(Session::has('errorMsg') && Session::get('errorMsg') == '1')
                <div class="alert-fix alert alert-success" role="alert" id="auto-disapper">
                    Database backup was token <b>successfully!</b>
                </div>
            @elseif(Session::has('errorMsg') && !Session::get('errorMsg') == '1') 
                <div class="alert alert-danger" id="success-alert" role="alert">
                    Something wrong happend! {{Session::get('errorMsg')}}
                </div>
            @endif
            
            <!-- <button id="myWish" > click yo fade in</button> -->
            <!--Summery content-->
            <div class="tab-content py-4">
                <div class="tab-pane active" id="Summery">
                    <h5 class="mb-3">User Profile</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <h6>About TBD</h6>
                            <p> Web Designer, UI/UX Engineer TBD </p>
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
                    <div class="panel-body">
                        {{ csrf_field() }}
                        <div id="post_data">

                        </div>
                </div> 
                </div>
                </div>
                <!--End activities content-->
                
                
                @if(Auth::user()->id == $users->id)
        <!-- Start Edit content-->
                <div class="tab-pane" id="edit" onclick="removeActiveClass('Summery')">
                <form method="POST" action="{{ route('change.password') }}"  oninput='new_confirm_password.setCustomValidity(new_confirm_password.value != new_password.value ? "Passwords do not match." : "")'>
                    {{ csrf_field() }}
   
                         @foreach ($errors->all() as $error)
                            <p class="text-danger">{{ $error }}</p>
                         @endforeach 
  
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Current Password</label>
  
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password" required>
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
                            <input type="file" class="form-control-file"  name="image" required>
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
               <!--End edit content-->

                <!-- Start Backup content-->
                @if(Auth::user()->rule == "1")
                <div class="tab-pane" id="Backup" onclick="removeActiveClass('Summery')">
                <p class="lead" >Creates a backup of <b>Alsejel</b>, The backup is a zipfile that contains a dump of the database. The backup is stored on
                    the path <q><b>storage\app\http---localhost<b></q> </p>
                    <div class="alert alert-info" role="alert">
                    Alsejel is scheduled to do the following rule everyday at 1 am (backup) :
                    <ol>
                        <li>Take a backup of DB</li>
                    </ol>
                    <br/>
                    Alsejel is scheduled to do the following rules everyday at 2 am (cleanup):
                    <ol>
                        <li>Keep all backups for the amount of days specified in 7 days</li>
                        <li>Keep daily backups for the amount of days specified in 16 days for all backups older than those that rule "1" takes care of</li>
                        <li>It’ll only keep weekly backups for the amount of months specified in 4 month all backups older than those that rule "2" takes care of</li>
                        <li>It will only keep yearly backups for the amount of years specified in 2 years for all backups older than those that rule "3" takes care of</li>
                        <li>It will start deleting old backups until the used storage is lower than the number specified in 5000 Megabytes</li>
                        <li>It will never delete the youngest backup regardless of it’s size or age</li>
                    </ol>
                    </div>
                <form method="POST" action="{{ route('Buckup') }}">
                    {{ csrf_field() }}                       
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="add-comment-btn btn-success">
                                    Backup DataBase Now
                                </button>
                                {{Session::has('msg')}}
                            </div>
                        </div>
                    </form>
                </div>
                @endif <!--   if the user is admin -->
                @endif  <!--  if this page is his page -->
               <!--End Backup content-->
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