
@extends('home')

@section('content2')                  
<div class="row">
              <div class="col-9 py-4">
                  <div class="row">
                  <h4>{{$task->name}} </h4>   
                @if($bool == true)

    <h6 style="margin-top:8px;"><a href="{{ url('task/'.$task->id.'/left') }}"  style = "color:blue ">  /Leave</a></h6>
@else

<h6 style="margin-top:8px;" ><a href="{{ url('task/'.$task->id.'/join') }}" style = "color:blue ">  /Join</a></h6>
    
@endif
             
</div>
                
    <p class="text-gray">{{$task->type}} / {{$task->created_at}} </p>
    <p class="text-black" style ="margin-top:20px;">Description</p>
    <div class="col-md-9 col-sm-12 col-12 equel-grid">
      <div class="grid" >
        <div class="grid-body text-gray">
          <p>{{$task->description}}</p>
        </div>
      </div>
    </div>
</div>
        <div class="col-3 py-1">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Log work</button>
              <br>
              <button type="button" class="add-comment-btn btn-success" data-toggle="modal" data-target="#AddComment" data-whatever="@getbootstrap">Comment</button>
              <br/>
              <p class="text-gray" style="margin-top:25px;"> 
                  <span style ="color:grey; font-size:18px;font-family: Times New Roman">Logged Time:</span>  <span style ="color:blue; font-size:18px;font-family: Times New Roman">{{$total_hours}}h  {{$total_minuts}}m </span>
              </p>
              <div class="pointer dropdown" style="margin-top:25px; font-size:18px;font-family: Times New Roman">
                  <i class="fa fa-caret-down" aria-hidden="true" class="btn btn-primary dropdown-toggle " data-toggle="dropdown"> People</i>
                  <div class="people_dropdown dropdown-menu">
                    @foreach($task->user as $user)
                        <a class="dropdown-item" href="/user/{{$user->id}}">{{$user->name}}</a>
                    @endforeach
                 </div>
              </div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Logwork</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="/task/{{$task->id}}" method="POST">
      {{ csrf_field() }}
      <div class="form-group">
          <label for="exampleFormControlSelect1" class="col-form-label" >Date:</label>
          <input name="date" class="form-control" type="date" required>
        </div>
        <div class="form-group">
         <label for="exampleFormControlSelect1" class="col-form-label">Duration of time:</label>
         <div class="row">  
        <div class="col-2">
            <input name="houres" type="number"  class="form-control" id="formGroupExampleInput" value="0" required>
        </div>
        <div class="col-2">
                <label for="formGroupExampleInput" class="col-form-label" >hours </label>
            </div>
        <div class="col-2">
            <input name="minutes" type="number"  class="form-control" id="formGroupExampleInput" value="0" required>
        </div>
            <div class="col-2">
            <label for="formGroupExampleInput" class="col-form-label">minutes</label>    
        </div>
        </div>
    </div>
    <label for="exampleFormControlTextarea1" class="col-form-label">Description:</label>
        <div class="form-group">
            
            <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="save" type="submit" class="btn btn-primary">Save</button>
      </div>
        </form>
      </div>
    </div>
  </div>
</div>  
            </div>
            </div>
              <div class="row my-2">
                        <div class="col-lg-12 order-lg-2">

                                <!--Navigation bar-->
                                <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                                <a href="" data-target="#Comments" data-toggle="tab" class="nav-link active" id="summery_tab" >Comments</a>
                                        </li>
                                        <li class="nav-item" >
                                                <a  href="" data-target="#Logwork" data-toggle="tab" class="nav-link" onclick="removeActiveClass('summery_tab')" >Work Logs</a>
                                        </li>
                                        <li class="nav-item">
                                                <a href="" data-target="#Activities" data-toggle="tab" class="nav-link" onclick="removeActiveClass('summery_tab')" >Activities</a>
                                        </li>
                                </ul>
                         </div>
                </div>
            
      <!--Summery content-->
      <div class="tab-content py-4">

      <!-- start Comments content-->
          <div class="tab-pane active" id="Comments" >
          {{-- start comment form --}}
        <div class="issuePanelWrapper">
        <div class="issuePanelContainer" >  
        @foreach ($comments as $comment)
        <div id="Comment-142295" class="issue-data-block">
          <div class="actionContainer">
              <div class="action-links">
{{--Edit Comments--}}

@if(Auth::user()->id == $comment->user->id)
        <a  href="#" data-toggle="modal" data-target="#CommentModal{{$comment->id}}" data-whatever="@getbootstrap" title="Edit" class="edit-worklog-trigger" style="margin:5px 5px 5px"><i class="fa fa-edit" aria-hidden="true"></i></a>
@endif
        <div class="modal fade" id="CommentModal{{$comment->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Comment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="/editComment/{{$comment->id}}" method="POST">
      {{ csrf_field() }}
      <div class="form-group">
        </div>
    <label for="exampleFormControlTextarea1" class="col-form-label">Your comment:</label>
        <div class="form-group">
            <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3" required>{{$comment->description}}</textarea>
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="save" type="submit" class="btn btn-primary">Save</button>
      </div>
        </form>
      </div>
    </div>
  </div>
</div> 
{{--End edit Comments--}} 

@if(Auth::user()->id == $comment->user->id)
                <form id="Delete_comment_form" action="/deleteComment/{{$comment->id}}" method="GET">
                    <a href="#" id="delete_worklog_142295"  title="Delete" class="delete-worklog-trigger" style="margin:5px 5px 5px"><i data-toggle="modal" data-target="#confirmCommentDelete" class="fa fa-trash" aria-hidden="true"></i></a>
                </form>
@endif
          
        </div>
        <div class="action-details">    
    <a href="#">{{$comment->user->name}}</a> -
  <span title="Rule: {{$comment->user->rule}}" class="subText"><span class="date"> commented at {{$comment->updated_at}}</span></span>
    </div>
        <div class="action-body">
            <ul id="worklog_details_142295" class="item-details">
                <li>
                    <dl>
                        <dt>&nbsp;</dt>
                        <dd id="wl-142295-c" class="worklog-comment">                                                        
                           <p>{{$comment->description}}.</p>
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


          </div>
      <!-- End Comments content-->
      
        <!-- start Logwork content-->

        <div class="tab-pane" id="Logwork" onclick="removeActiveClass('Comments')" >
        {{-- start logwork form --}}
        <div class="issuePanelWrapper">
        <div class="issuePanelContainer" id="issue_actions_container">  
        @foreach ($logworks as $logwork)
        <div id="worklog-142295" class="issue-data-block">
          <div class="actionContainer">
              <div class="action-links">

{{--Edit logwork--}}
@if(Auth::user()->id == $logwork->user->id)
        <a  href="#" data-toggle="modal" data-target="#EditModal{{$logwork->id}}" data-whatever="@getbootstrap" title="Edit" class="edit-worklog-trigger" style="margin:5px 5px 5px"><i class="fa fa-edit" aria-hidden="true"></i></a>
@endif
        <div class="modal fade" id="EditModal{{$logwork->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit work log</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="/editLogwork/{{$logwork->id}}" method="POST">
      {{ csrf_field() }}
      <div class="form-group">
          <label for="exampleFormControlSelect1" class="col-form-label" >Date:</label>
          <input name="date" class="form-control" value="{{$logwork->date}}" type="date" required>
        </div>
        <div class="form-group">
         <label for="exampleFormControlSelect1" class="col-form-label">Deuration of time:</label>
         <div class="row">  
        <div class="col-2">
            <input name="houres" type="number"  value="{{$logwork->houre}}" class="form-control" id="formGroupExampleInput" required>
        </div>
        <div class="col-2">
                <label for="formGroupExampleInput" class="col-form-label" >hours </label>
            </div>
            <div class="col-2">
                    <div id="delta">
                    </div>  
            </div>
        <div class="col-2">
            <input name="minutes" type="number" value="{{$logwork->minute}}"  class="form-control" id="formGroupExampleInput" value="0" required>
        </div>
            <div class="col-2">
            <label for="formGroupExampleInput" class="col-form-label">minutes</label>    
        </div>
        </div>
    </div>
    <label for="exampleFormControlTextarea1" class="col-form-label">Description:</label>
        <div class="form-group">
            
            <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3" required>{{$logwork->description}}</textarea>
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="save" type="submit" class="btn btn-primary">Save</button>
      </div>
        </form>
      </div>
    </div>
  </div>
</div> 
        {{--End edit logwork--}}
        @if(Auth::user()->id == $logwork->user->id)
                <form id="Delete_logwork_form" action="/delete/{{$logwork->id}}" method="GET">
                    <a href="#" id="delete_worklog_142295"  title="Delete" class="delete-worklog-trigger" style="margin:5px 5px 5px"><i data-toggle="modal" data-target="#confirmLogworkDelete" class="fa fa-trash" aria-hidden="true"></i></a>
                </form>
        @endif
        </div>
        <div class="action-details">    
    <a href="#">{{$logwork->user->name}}</a>
 logged work  - <span title="Created: {{$logwork->user->created_at}}" class="subText"><span class="date">{{$logwork->date}}</span></span>  </div>
        <div class="action-body">
            <ul id="worklog_details_142295" class="item-details">
                <li>
                    <dl>
                        <dt>Time Spent:</dt>
                        <dd id="wl-142295-d" class="worklog-duration">{{$logwork->houre}} houres, {{$logwork->minute}} minutes</dd>
                    </dl>
                    <dl>
                        <dt>&nbsp;</dt>
                        <dd id="wl-142295-c" class="worklog-comment">                                                        
<p>{{$logwork->description}} .</p>
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
</div>
 <!-- End Logwork content-->


<!--Activities content-->
<div class="tab-pane" id="Activities" onclick="removeActiveClass('Summery')">
    <div class="action-details">
      @foreach($task_all_activities as $activity)
        <div class = 'issue-data-block'>
            <div class="actionContainer">
                <div class="action-details">    
                    @if (empty($activity->hour))
                      <a href="#">{{$comment->user->name}}</a> -
                    @else
                      <a href="#">{{$logwork->user->name}}</a> -
                    @endif
                    <span title="Rule: 1" class="subText">
                        <span class="date">
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
                        </span>
                    </span>
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


<!--Start confirm the delete logwork form-->
<div class="modal fade" id="confirmLogworkDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLab" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLab">Delete Logwork</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          You are going to delete the log work, Are you sure?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Close</button>
          <input  type="submit" form="Delete_logwork_form" value="Yes, Delete" class="btn btn-primary"/>     
        </div>
      </div>
    </div>
  </div>
<!--End confirm the delete form-->

<!--Start confirm the delete comment form-->
<div class="modal fade" id="confirmCommentDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLab" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLab">Delete Comment</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          You are going to delete the comment, Are you sure?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Close</button>
          <input  type="submit" form="Delete_comment_form" value="Yes, Delete" class="btn btn-primary"/>     
        </div>
      </div>
    </div>
  </div>
<!--End confirm the delete form-->

<!--Start add comment form-->
<div class="modal fade" id="AddComment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add comment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="/AddComment/{{$task->id}}" method="POST">
      {{ csrf_field() }}
        <div class="form-group">   
            <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="save" type="submit" class="btn btn-primary">Add</button>
      </div>
        </form>
      </div>
    </div>
  </div>
</div> 
<!--End add comment form-->
@endsection