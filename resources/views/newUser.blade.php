@extends('home')

@section('content2')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        <p style="text-align:center ; font-size:25px">Welcome to <span style="color:blue">Scace</span> company </p>
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/CreateNewUser') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- start rule -->
                        <div class="form-group{{ $errors->has('rule') ? ' has-error' : '' }}">
                            <label for="rule" class="col-md-4 control-label">Rule</label>

                            <div class="col-md-6">
                               
                                    <select id="rule" name="rule" class="form-control" id="sel1" required>
                                        <option value="1">Admin</option>
                                        <option value="2">User</option>
                                    </select>
                                        
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('rule') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- end rule -->

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> 


                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@if(Session::has('errorMsg') && Session::get('errorMsg') == '1')
    <div class="alert-fix alert alert-success" role="alert" id="auto-disapper">
        Database backup was token <b>successfully!</b>
    </div>
@elseif(Session::has('errorMsg') && !Session::get('errorMsg') == '1') 
    <div class="alert alert-danger" id="success-alert" role="alert">
        Something wrong happend! {{Session::get('errorMsg')}}
    </div>
@endif


@endsection