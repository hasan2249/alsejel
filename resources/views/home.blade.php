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
                        <a href="users" class="list-group-item">Users</a>
                        <a href="tasks" class="list-group-item">Tasks</a>
                        <a href="#" class="list-group-item">Reports</a>
                        <a href="#" class="list-group-item">Disabled</a>
                        <a href="#" class="list-group-item">Disabled</a>
                        <a href="#" class="list-group-item">Disabled</a>
                    </ul>
                    {{--end pages links --}}
                </div>
            </div>
        </div>
        {{-- col-md-offset-4 --}}
        <div class="col-md-9 ">
            <div class="panel panel-default">
                <div class="panel-heading text-center">SCASE</div>

                <div class="panel-body"> 
                   @yield('content2')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
