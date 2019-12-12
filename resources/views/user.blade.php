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
                @endif
            </ul>

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
                    @foreach($user_all_activities as $activity)
                    <div class = 'issue-data-block'>
                    <div class="actionContainer">
                        <div class="action-details">    
                            <a href="#">{{$users->name}}</a> -
                            <span title="Rule: 1" class="subText"><span class="date">
                            @if ($activity->updated_at > $activity->created_at)
                                @if (empty($activity->hour))
                                    Updated his comment at: {{$activity->updated_at}}.
                                @else
                                    Updated his log  at: {{$activity->updated_at}}, to {{$activity->hour}} hours and {{$activity->minute}} minutes.
                                @endif
                            @else
                                @if (empty($activity->hour))
                                    Added a new comment at: {{$activity->updated_at}}.
                                @else
                                    Logged work at: {{$activity->updated_at}}, with {{$activity->hour}} hours and {{$activity->minute}} minutes.
                                @endif
                            @endif
                            </span></span>
                        </div>
                            <div class="action-body">
                                <ul id="worklog_details_142295" class="item-details">
                                <li>
                                <dl>
                                <dt>&nbsp;</dt>
                                <dd id="wl-142295-c" class="worklog-comment">                                                        
                                <p>{{$activity->description}}.</p>
                                </dd>
                                </dl>
                                </li>
                                </ul>
                            </div>
                    </div>
                    </div>
                    @endforeach
                </div> 
                </div>
                <!--End activities content-->
                
                
                @if(Auth::user()->id == $users->id)
                <!--edit content-->
                <div class="tab-pane" id="edit" onclick="removeActiveClass('Summery')">
                <form method="POST" action="{{ route('change.password') }}">
                    {{ csrf_field() }}
   
                         @foreach ($errors->all() as $error)
                            <p class="text-danger">{{ $error }}</p>
                         @endforeach 
  
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Current Password</label>
  
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">
                            </div>
                        </div>
  
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>
  
                            <div class="col-md-6">
                                <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">
                            </div>
                        </div>
  
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">New Confirm Password</label>
    
                            <div class="col-md-6">
                                <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">
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
                </div>
               @endif
            </div>
        </div>
    </div>
    <script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }
  </script>
    @endsection