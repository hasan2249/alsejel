@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3 ">
            <div class="panel panel-default">
                <div class="panel-heading">side bar</div>

                <div class="panel-body">
                    {{--start pages links --}}
                    <ul class="list-group list-group-flush">
                        <a href="#" class="list-group-item">Users</a>
                        <li class="list-group-item">Tasks</li>
                        <li class="list-group-item">Disabled</li>
                        <li class="list-group-item">Disabled</li>
                        <li class="list-group-item">Disabled</li>
                        <li class="list-group-item">Disabled</li>
                    </ul>
                    {{--end pages links --}}
                </div>
            </div>
        </div>
        {{-- col-md-offset-4 --}}
        <div class="col-md-9 ">
            <div class="panel panel-default">
                <div class="panel-heading">Tasks</div>

                <div class="panel-body">
                   Congratulation You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
