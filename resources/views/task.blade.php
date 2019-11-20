
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
              </div>
              <div class="col-3 py-1">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Add logwork</button>
              <div class="dropdown" style="margin-top:25px;">
              <i class="fa fa-caret-down" aria-hidden="true" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"> People</i>
            <div class="dropdown-menu">
            @foreach($task->user as $user)
            <a class="dropdown-item" href="#">{{$user->name}}</a>
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
                <label for="exampleFormControlSelect1" class="col-form-label">Date:</label>
        </div>
        <div class="form-group">
         <label for="exampleFormControlSelect1" class="col-form-label">Deuration of time:</label>
         <div class="row">  
        <div class="col-2">
            <input name="houres" type="number"  class="form-control" id="formGroupExampleInput" required>
        </div>
        <div class="col-2">
                <label for="formGroupExampleInput" class="col-form-label" >hours</label>
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
            <div class="row">
              <div class="col-md-6 col-sm-12 col-12 equel-grid">
                <div class="grid" style ="margin-top:-20px;">
                  <div class="grid-body text-gray">
                    <p>{{$task->description}}</p>
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
                                   <div class="tab-pane active" id="Comments" >

                                        </div>

                                        <!--Logwork content-->
                                        <div class="tab-pane" id="Logwork" onclick="removeActiveClass('Comments')" >
                                        {{-- start logwork form --}}
                                        <div class="issuePanelWrapper">
        <div class="issuePanelContainer" id="issue_actions_container">  
        @foreach ($logworks as $logwork)
        
   <div id="worklog-142295" class="issue-data-block">
    <div class="actionContainer">
        <div class="action-links">
        <a id="edit_worklog_142295" href="#" title="Edit" class="edit-worklog-trigger" style="margin:5px 5px 5px"><i class="fa fa-edit" aria-hidden="true"></i></span></a>
        <a id="delete_worklog_142295" href="#" title="Delete" class="delete-worklog-trigger" style="margin:5px 5px 5px"><i class="fa fa-trash" aria-hidden="true"></i></span></a>
                    </div>
        <div class="action-details">    
    
    <a href="#">{{$logwork->user->name}}</a>
 logged work  - <span title="Created: {{$logwork->user->created_at}}" class="subText"><span class="date">{{$logwork->user->created_at}}</span></span>  </div>
        <div class="action-body">
            <ul id="worklog_details_142295" class="item-details">
                <li>
                    <dl>
                        <dt>Time Spent:</dt>
                        <dd id="wl-142295-d" class="worklog-duration">{{$logwork->houre}} / {{$logwork->minute}}</dd>
                    </dl>
                    <dl>
                        <dt>&nbsp;</dt>
                        <dd id="wl-142295-c" class="worklog-comment">
                                                            
<p><a href="#" title="DSIA Project Initiation" class="issue-link" data-issue-key="AUZSDFIN-446">{{$task->name}}</a>:</p>

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

                                         <!--Activities content-->
   <div class="tab-pane" id="Activities" onclick="removeActiveClass('Comments')" >

   </div>


@endsection