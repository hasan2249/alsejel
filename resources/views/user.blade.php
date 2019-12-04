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
                <li class="nav-item">
                    <a href="" data-target="#edit" data-toggle="tab" class="nav-link"
                        onclick="removeActiveClass('summery_tab')">Edit</a>
                </li>
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
                <!-- <div class="table-responsive">
                    <table class="table table-hover">
                        <tbody>
                            @foreach($user_all as $comment)
                            <tr>
                                <td>
                                <div style="width:100%;
                                  overflow: hidden;
                                text-overflow: ellipsis;height=90px;">
                                <b>{{$users->name}}:</b> updated the comment: {{$comment->description}}</td>
                                </div>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                    </div> -->
                </div>

                <!--edit content-->
                <div class="tab-pane" id="edit" onclick="removeActiveClass('Summery')">
                    <form role="form">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Password</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="password" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Confirm password</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="password" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label" />
                            <div class="col-lg-9">
                                <input type="reset" class="btn btn-secondary" value="Cancel">
                                <input type="button" class="btn btn-primary" value="Save Changes">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection