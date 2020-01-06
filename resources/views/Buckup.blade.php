@extends('home')

@section('content2')

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
                        <li>Keep all backups for 7 days</li>
                        <li>Keep daily backups for 16 days for all backups older than those that rule "1" takes care of</li>
                        <li>It’ll only keep weekly backups for 4 month all backups older than those that rule "2" takes care of</li>
                        <li>It will only keep yearly backups for 2 years for all backups older than those that rule "3" takes care of</li>
                        <li>It will start deleting old backups until the used storage is lower than 5000 Megabytes</li>
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
               <!--End Backup content-->

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