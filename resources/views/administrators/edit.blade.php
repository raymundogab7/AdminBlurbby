@extends('layouts.admin')

@section('page-title', 'Administrators')

@section('custom-css')

<link href="{{asset('css/bootstrap-timepicker.min.css')}}" rel="stylesheet">
@endsection

@section('body-contents')
    <section>
        <div class="mainwrapper">
            @include('layouts.sidebar-admin')
            <div class="mainpanel">
                <div class="pageheader">
                    <div class="media">
                        <div class="pageicon pull-left">
                            <i class="fa fa-user-secret"></i>
                        </div>
                        <div class="media-body">
                            <ul class="breadcrumb">
                                <li><a href="{{url('dashboard')}}"><i class="glyphicon glyphicon-home"></i></a></li>
                                <li><a href="{{url('administrators')}}">Administrators</a></li>
                                <li>{{$admin->first_name}} {{$admin->last_name}}</li>
                            </ul>
                            <h4>{{$admin->first_name}} {{$admin->last_name}}</h4>
                        </div>
                    </div><!-- media -->
                </div><!-- pageheader -->
                <div class="contentpanel">
                    <div class="row">
                        <div class="col-sm-12 col-md-3 col-xs-12" style="padding-bottom:30px;max-width:417px;min-width:300px;">
                            <div style="border: 1px solid #ccc;">
                                <div class="text-center" style="background:url({{asset('images/profile-background.jpg')}});    background-size:cover;">
                                    @if($admin->profile_photo == null || $admin->profile_photo == '')
                                    <?php $pp_url = asset('images/photos/profile-big.jpg');?>
                                    @else
                                    <?php $pp_url = asset($admin->profile_photo);?>
                                    @endif

                                    <img src="{{$pp_url}}" class="img-circle img-offline img-responsive img-profile" style="max-width:80px;margin-top:45px;" alt="" />
                                    <h4 class="profile-name mb5" style="color:#fff;padding-bottom:45px;font-size:16px;margin-top:5px;">Royce Cheng</h4>

                                </div><!-- text-center -->
                                <div class="mb20"></div>
                                <div style="text-align:center;padding:10px 0;"><span id="keyup_title">{{$admin->title}}</span></div>
                                <div class="mb20"></div>
                                <table style="width:100%;">
                                    <tbody>
                                        <tr style="border-top:1px solid #ccc;">
                                            <td style="width:50%;padding-left:25px;">First Name</td>
                                            <td style="padding:15px 25px 15px 0;text-align:right;"><span id="keyup_first_name">{{$admin->first_name}}</span></td>
                                        </tr>
                                        <tr style="border-top:1px solid #ccc;">
                                            <td style="width:50%;padding-left:25px;">Last Name</td>
                                            <td style="padding:15px 25px 15px 0;text-align:right;"><span id="keyup_last_name">{{$admin->last_name}}</span></td>
                                        </tr>
                                        <tr style="border-top:1px solid #ccc;">
                                            <td style="width:50%;padding-left:25px;">Email</td>
                                            <td style="padding:15px 25px 15px 0;text-align:right;"><span id="keyup_email">{{$admin->email}}</span></td>
                                        </tr>
                                        <tr style="border-top:1px solid #ccc;">
                                            <td style="width:50%;padding-left:25px;">Date Of Birth</td>
                                            <td style="padding:15px 25px 15px 0;text-align:right;"><span id="keyup_date_of_birth">{{date_format(date_create($admin->date_of_birth), 'd-M-Y')}}</span></td>
                                        </tr>
                                        <tr style="border-top:1px solid #ccc;">
                                            <td style="width:50%;padding-left:25px;">Gender</td>
                                            <td style="padding:15px 25px 15px 0;text-align:right;"><span id="keyup_gender">{{$admin->gender}}</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- col-sm-4 col-md-3 -->

                        <div class="col-sm-12 col-md-9 col-xs-12">
                            @if(session('message'))

                            <div class="alert alert-success">
                                <strong>{{session('message')}}</strong>
                            </div>

                            @endif

                            @if(session('error'))

                            <div class="alert alert-danger">
                               <strong>{{session('error')}}</strong>
                            </div>

                            @endif

                            @if(count($errors) > 0)

                            <div class="alert alert-danger">
                                <ul class="media-list">

                                @foreach($errors as  $v)

                                    <li class="media">

                                          <strong> {{str_replace('.1', '', $v[0])}}</strong>

                                    </li>

                                @endforeach

                                </ul>
                            </div>

                            @endif
                            <form action="{{url('administrators/'.$admin->id)}}" accept-charset="UTF-8" class="form-horizontal form-bordered" method="POST" files="true" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">Status *</label>
                                    <div class="col-sm-8">
                                        <!-- <select id="status" data-placeholder="Choose One" class="width300">
                                            <option value="" selected="selected">Choose One</option>
                                            <option value="Approved">Approved</option>
                                            <option value="Pending Email Approval">Pending Email Approval</option>
                                            <option value="Blocked">Blocked</option>
                                        </select> -->
                                        {!! Form::select('status', array('Approved' => 'Approved', 'Disabled' => 'Disabled', 'Blocked' => 'Blocked'), $admin->status, ['id' => 'type', 'required' => 'required', 'class' => 'width300']) !!}
                                    </div>
                                </div><!-- form-group -->

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">Type *</label>
                                    <div class="col-sm-8">
                                        <input type="hidden" name="_token" readonly="" value="{{csrf_token()}}">
                                        <input type="hidden" name="_method" readonly="" value="PUT">
                                        <input type="hidden" name="admin_id" readonly="" value="{{$admin->id}}">
                                        <!-- <select id="type" name="role_id" data-placeholder="Choose One" class="width300" required="required" />
                                            <option value="" selected="selected">Choose One</option>
                                            <option value="1">Super Administrator</option>
                                            <option value="2">Administrator</option>
                                        </select> -->
                                        {!! Form::select('role_id', array('1' => 'Super Administrator', '2' => 'Administrator'), $admin->role_id, ['id' => 'type', 'required' => 'required', 'class' => 'width300', 'placeholder' => 'Choose One']) !!}
                                    </div>
                                </div><!-- form-group -->

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">Title *</label>
                                    <div class="col-sm-8">
                                        {!! Form::text('title', $admin->title, ['id' => 'title', 'required' => 'required', 'class' => 'form-control']) !!}
                                    </div>
                                </div><!-- form-group -->

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">Profile Photo</label>
                                    <div class="col-sm-5">
                                        <!-- <input name="file" type="file" name="profile_photo" required="required" /> -->
                                        {!! Form::file('profile_photo_temp', null, []) !!}
                                        <span class="help-block">Must be at least 500px x 500px.</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">First Name *</label>
                                    <div class="col-sm-8">
                                        <!-- <input type="text" id="first_name" name="first_name" class="form-control" required="required" /> -->
                                        {!! Form::text('first_name', $admin->first_name, ['id' => 'first_name', 'required' => 'required', 'class' => 'form-control']) !!}
                                    </div>
                                </div><!-- form-group -->

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">Last Name *</label>
                                    <div class="col-sm-8">
                                        <!-- <input type="text" id="last_name" name="last_name" class="form-control" required="required" /> -->
                                        {!! Form::text('last_name', $admin->last_name, ['id' => 'last_name', 'required' => 'required', 'class' => 'form-control']) !!}
                                    </div>
                                </div><!-- form-group -->

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">Email *</label>
                                    <div class="col-sm-8">
                                        <!-- <input type="email" id="email" name="email" class="form-control" required="required" /> -->
                                        {!! Form::email('email', $admin->email, ['id' => 'email', 'required' => 'required', 'class' => 'form-control']) !!}
                                    </div>
                                </div><!-- form-group -->

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">Date Of Birth *</label>
                                    <div class="col-sm-2">
                                        <div class="input-group">
                                            <!-- <input type="text" name="date_of_birth" class="form-control"  id="datepicker" required="required"> -->
                                            {!! Form::text('date_of_birth', date_format(date_create($admin->date_of_birth), 'd-M-Y'), ['id' => 'datepicker', 'required' => 'required', 'class' => 'form-control']) !!}
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                        </div><!-- input-group -->
                                    </div>
                                </div><!-- form-group -->

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">Gender *</label>
                                    <div class="col-sm-8">
                                        <!-- <select id="gender" name="gender" data-placeholder="Choose One" class="width300" required="required" />
                                            <option value="" selected="selected">Choose One</option>
                                            <option value="Female">Female</option>
                                            <option value="Male">Male</option>
                                        </select> -->
                                        {!! Form::select('gender', array('Female' => 'Female', 'Male' => 'Male'), $admin->gender, ['onchange' => 'changeGender(this)', 'id' => 'gender', 'required' => 'required', 'class' => 'width300', 'placeholder' => 'Choose One']) !!}
                                    </div>
                                </div><!-- form-group -->

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">New Password</label>
                                    <div class="col-sm-8">
                                        <input type="password" name="password" placeholder="" class="form-control" />
                                    </div>
                                </div><!-- form-group -->

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">Confirm Password Again</label>
                                    <div class="col-sm-8">
                                        <input type="password" name="password_confirmation" placeholder="" class="form-control" />
                                    </div>
                                </div><!-- form-group -->
                                <br>
                                <button style="margin-left:15px;" class="btn btn-primary">Update</button>
                                <a href="{{url('administrators')}}"><button type="button" style="margin-left:15px;" class="btn btn-default">Back</button></a>
                            </form>
                        </div><!-- tab-content -->

                        </div><!-- col-sm-9 -->
                    </div><!-- row -->

                </div><!-- contentpanel -->

            <input type="hidden" id="search_url" value="{{url('')}}">
@endsection

@section('custom-js')
<script type="text/javascript" src="{{asset('js/jquery-ui-1.10.3.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap-timepicker.min.js')}}"></script>
<script>
    // Select2
    jQuery('select').select2({
        minimumResultsForSearch: -1
    });

    // Date Picker
    jQuery('#datepicker').datepicker({
        dateFormat: 'dd-M-yy',
        maxDate: 0,
        onSelect: function(dateText) {
            $('#keyup_date_of_birth').html($.datepicker.formatDate('dd-M-yy', new Date($(this).val())));
        }
    });

    $('#title').keyup(function(){
        $('#keyup_title').html($(this).val());
    });

    $('#first_name').keyup(function(){
        $('#keyup_first_name').html($(this).val());
    });

    $('#last_name').keyup(function(){
        $('#keyup_last_name').html($(this).val());
    });

    $('#email').keyup(function(){
        $('#keyup_email').html($(this).val());
    });


    $('#changeGender').change(function(gender){
        $('#keyup_gender').html($(gender).val());
    });

    function changeGender(gender) {
        $('#keyup_gender').html($(gender).val());
    }
</script>
@endsection
