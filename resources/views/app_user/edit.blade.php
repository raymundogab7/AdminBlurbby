@extends('layouts.admin')

@section('page-title', $app_user->first_name. ' ' . $app_user->last_name)

@section('custom-css')

<link href="{{asset('css/bootstrap-timepicker.min.css')}}" rel="stylesheet">
<link href="{{asset('css/style.datatables.css')}}" rel="stylesheet">
<link href="//cdn.datatables.net/responsive/2.1.0/css/responsive.dataTables.min.css" rel="stylesheet">
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
                                <li><a href="{{url('app-users')}}">App Users</a></li>
                                <li>{{$app_user->first_name. ' ' . $app_user->last_name}}</li>
                            </ul>
                            <h4>{{$app_user->first_name. ' ' . $app_user->last_name}}</h4>
                        </div>
                    </div><!-- media -->
                </div><!-- pageheader -->
                <div class="contentpanel">
                    <div class="row">
                        <div class="col-sm-12 col-md-3 col-xs-12" style="padding-bottom:30px;max-width:417px;min-width:300px;">
                            <div style="border: 1px solid #ccc;">
                                @if($app_user->profile_photo == null || $app_user->profile_photo == '')
                                <?php $pp_url = asset($app_user->profile_photo);?>
                                @else
                                <?php $pp_url = $app_user->profile_photo;?>
                                @endif
                                <div class="text-center" style="background:url({{asset('images/profile-background.jpg')}});    background-size:cover;">
                                    <img src="{{asset($pp_url)}}" class="img-circle img-offline img-responsive img-profile" style="max-width:80px;margin-top:45px;" alt="" />
                                    <h4 class="profile-name mb5" style="color:#fff;padding-bottom:45px;font-size:16px;margin-top:5px;">{{$app_user->first_name. ' ' . $app_user->last_name}}</h4>

                                </div><!-- text-center -->
                                <div class="mb20"></div>
                                <div style="text-align:center;padding:10px 0;"><i class="fa fa-tags"></i> Bookmarked {{$count_bookmarked_blurbs}} blurbs and {{$count_bookmarked_merchant}} restaurants</div>
                                <div style="text-align:center;padding:10px 0;"><i class="fa fa-tags"></i> Used {{$count_used_blurbs}} blurbs</div>
                                <div class="mb20"></div>
                                <table style="width:100%;">
                                    <tbody>
                                        <tr style="border-top:1px solid #ccc;">
                                            <td style="width:50%;padding-left:25px;">First Name</td>
                                            <td style="padding:15px 25px 15px 0;text-align:right;">{{$app_user->first_name}}</td>
                                        </tr>
                                        <tr style="border-top:1px solid #ccc;">
                                            <td style="width:50%;padding-left:25px;">Last Name</td>
                                            <td style="padding:15px 25px 15px 0;text-align:right;">{{$app_user->last_name}}</td>
                                        </tr>
                                        <tr style="border-top:1px solid #ccc;">
                                            <td style="width:50%;padding-left:25px;">Email</td>
                                            <td style="padding:15px 25px 15px 0;text-align:right;">{{$app_user->email}}</td>
                                        </tr>
                                        <tr style="border-top:1px solid #ccc;">
                                            <td style="width:50%;padding-left:25px;">Date Of Birth</td>
                                            <td style="padding:15px 25px 15px 0;text-align:right;">{{$app_user->date_of_birth}}</span></td>
                                        </tr>
                                        <tr style="border-top:1px solid #ccc;">
                                            <td style="width:50%;padding-left:25px;">Gender</td>
                                            <td style="padding:15px 25px 15px 0;text-align:right;">{{$app_user->gender}}</td>
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

                             <!-- Nav tabs -->
                            <ul class="nav nav-tabs nav-line">
                                <li class="active"><a href="#personal" data-toggle="tab"><strong>Personal</strong></a></li>
                                <li><a href="#myblurbs" data-toggle="tab"><strong>Bookmarked Blurbs</strong></a></li>
                                <li><a href="#mymerchants" data-toggle="tab"><strong>Bookmarked Merchants</strong></a></li>
                                <li><a href="#usage" data-toggle="tab"><strong>Usage</strong></a></li>
                            </ul>

                            <!-- Tab panes -->
                                <div class="tab-content nopadding noborder">
                                    <div class="tab-pane active" id="personal">

                                        <form action="{{url('app-users/'.$app_user->id)}}" accept-charset="UTF-8" class="form-horizontal form-bordered" method="POST" files="true" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" style="text-align:left;">Status *</label>
                                                <div class="col-sm-8">
                                                    <input type="hidden" name="_token" readonly="" value="{{csrf_token()}}">
                                                    <input type="hidden" name="_method" readonly="" value="PUT">
                                                    <input type="hidden" name="app_user_id" readonly="" value="{{$app_user->id}}">
                                                    {!! Form::select('status', array('Approved' => 'Approved', 'Pending Email Verification' => 'Pending Email Verification', 'Blocked' => 'Blocked'), $app_user->status, ['id' => 'type', 'required' => 'required', 'class' => 'width300', 'placeholder' => 'Choose One']) !!}
                                                </div>
                                            </div><!-- form-group -->
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" style="text-align:left;">Profile Photo</label>
                                                <div class="col-sm-5">
                                                    <!-- <input name="file" type="file" name="profile_photo" required="required" /> -->
                                                    {!! Form::file('profile_photo_temp', null, ['required' => 'required']) !!}
                                                    <span class="help-block">Must be at least 500px x 500px.</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" style="text-align:left;">First Name *</label>
                                                <div class="col-sm-8">
                                                    <!-- <input type="text" id="first_name" name="first_name" class="form-control" required="required" /> -->
                                                    {!! Form::text('first_name', $app_user->first_name, ['id' => 'first_name', 'required' => 'required', 'class' => 'form-control']) !!}
                                                </div>
                                            </div><!-- form-group -->

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" style="text-align:left;">Last Name *</label>
                                                <div class="col-sm-8">
                                                    <!-- <input type="text" id="last_name" name="last_name" class="form-control" required="required" /> -->
                                                    {!! Form::text('last_name', $app_user->last_name, ['id' => 'last_name', 'required' => 'required', 'class' => 'form-control']) !!}
                                                </div>
                                            </div><!-- form-group -->

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" style="text-align:left;">Email *</label>
                                                <div class="col-sm-8">
                                                    <!-- <input type="email" id="email" name="email" class="form-control" required="required" /> -->
                                                    {!! Form::email('email', $app_user->email, ['id' => 'email', 'required' => 'required', 'class' => 'form-control']) !!}
                                                </div>
                                            </div><!-- form-group -->

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" style="text-align:left;">Date Of Birth *</label>
                                                <div class="col-sm-2">
                                                    <div class="input-group">
                                                        <!-- <input type="text" name="date_of_birth" class="form-control"  id="datepicker" required="required"> -->
                                                        {!! Form::text('date_of_birth', date_format(date_create($app_user->date_of_birth), 'd-M-Y'), ['id' => 'datepicker', 'required' => 'required', 'class' => 'form-control']) !!}
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
                                                    {!! Form::select('gender', array('Female' => 'Female', 'Male' => 'Male'), $app_user->gender, ['onchange' => 'changeGender(this)', 'id' => 'gender', 'required' => 'required', 'class' => 'width300', 'placeholder' => 'Choose One']) !!}
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
                                    </div><!-- tab-pane -->

                                    <div class="tab-pane" id="myblurbs">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="bookmarked_blurbs">
                                                <thead>
                                                    <tr>
                                                        <th>Blurb Image</th>
                                                        <th>Blurb Title</th>
                                                        <th>Status</th>
                                                        <th>Category</th>
                                                        <th>Start Date</th>
                                                        <th>End Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($app_user_blurb as $aub)
                                                    <tr>
                                                        @if(!is_null($aub->blurb_logo))
                                                        @if($aub->photo_location == 'merchant')
                                                        <td><img src="{{env('MERCHANT_URL').'/'.$aub->blurb_logo}}" style="width:20px"></td>
                                                        @else
                                                        <td><img src="{{asset($aub->blurb_logo)}}" style="width:20px"></td>
                                                        @endif
                                                        @else
                                                        <td>No Image Available</td>
                                                        @endif
                                                        <td><a href="{{url('blurb/'.$aub->id.'/'.$aub->ccn)}}">{{$aub->blurb_name}}</a></td>
                                                        <td>
                                                            @if($aub->blurb_status == 'Approved')
                                                            <span class="text-success">
                                                            @elseif($aub->blurb_status == 'Created')
                                                            <span class="text-info">
                                                            @elseif($aub->blurb_status == 'Live')
                                                            <span class="text-success">
                                                            @elseif($aub->blurb_status == 'Expired')
                                                            <span class="text-muted">
                                                            @elseif($aub->blurb_status == 'Rejected')
                                                            <span class="text-danger">
                                                            @else
                                                            <span class="text-warning">
                                                            @endif
                                                            <strong>{{$aub->blurb_status}}</strong>
                                                            </span>
                                                        </td>
                                                        <td>{{$aub->blurb_cat_name}}</td>
                                                        <td><?php echo date_format(date_create($aub->blurb_start), 'M-d-Y'); ?></td>
                                                        <td><?php echo date_format(date_create($aub->blurb_end), 'M-d-Y'); ?></td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div><!-- table-responsive -->
                                    </div><!-- tab-pane -->

                                    <div class="tab-pane" id="mymerchants">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="bookmarked_merchants">
                                                <thead>
                                                    <tr>
                                                        <th>Merchant Logo</th>
                                                        <th>Merchant Name</th>
                                                        <th>No. of Live Campaigns</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($bookmarked_merchants as $bm)
                                                    <tr>
                                                        @if(!is_null($bm['restaurant']['res_logo']))
                                                        @if($bm['restaurant']['photo_location'] == 'merchant')
                                                        <td><img src="{{env('MERCHANT_URL').'/'.$bm['restaurant']['res_logo']}}" style="width:20px"></td>
                                                        @else
                                                        <td><img src="{{asset($bm['restaurant']['res_logo'])}}" style="width:20px"></td>
                                                        @endif
                                                        @else
                                                        <td>No Image Available</td>
                                                        @endif
                                                        <td><a href="{{url('endifmerchants/'.$bm['restaurant']['merchant_id'].'/edit')}}">{{$bm['restaurant']['res_name']}}</a></td>
                                                        <td>{{\Admin\Campaign::where(['restaurant_id' => $bm['restaurant_id'], 'cam_status' => 'Live'])->count()}}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div><!-- table-responsive -->
                                    </div><!-- tab-pane -->

                                    <div class="tab-pane" id="usage">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="usage_table">
                                                <thead>
                                                    <tr>
                                                        <th>Blurb Image</th>
                                                        <th>Blurb Title</th>
                                                        <th>Status</th>
                                                        <th>Category</th>
                                                        <th>Start Date</th>
                                                        <th>End Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($usage as $u)
                                                    <tr>
                                                        @if(!is_null($u['blurb']['blurb_logo']))
                                                        @if($u['blurb']['photo_location'] == 'merchant')
                                                        <td><img src="{{env('MERCHANT_URL').'/'.$u['blurb']['blurb_logo']}}" style="width:20px;"></td>
                                                        @else
                                                        <td><img src="{{asset($u['blurb']['blurb_logo'])}}" style="width:20px;"></td>
                                                        @endif
                                                        @else
                                                        <td><img src="{{env('APP_URL')}}/images/photos/user1.png" style="width:20px;"></td>
                                                        @endif
                                                        <td><a href="{{url('blurb/'.$u['blurb']['id'].'/'.$u['blurb']['campaign']['control_no'])}}">{{$u['blurb']['blurb_name']}}</a></td>
                                                        <td>
                                                        @if($u['blurb']['blurb_status'] == 'Approved')
                                                        <span class="text-success">
                                                        @elseif($u['blurb']['blurb_status'] == 'Created')
                                                        <span class="text-info">
                                                        @elseif($u['blurb']['blurb_status'] == 'Live')
                                                        <span class="text-success">
                                                        @elseif($u['blurb']['blurb_status'] == 'Expired')
                                                        <span class="text-muted">
                                                        @elseif($u['blurb']['blurb_status'] == 'Rejected')
                                                        <span class="text-danger">
                                                        @else
                                                        <span class="text-warning">
                                                        @endif
                                                        <strong>{{$u['blurb']['blurb_status']}}</strong>
                                                        </span>
                                                    </td>
                                                        <td>{{$u['blurb']['category']['blurb_cat_name']}}</td>
                                                        <td>{{date_format(date_create($u['blurb']['blurb_start']), 'd-M-Y')}}</td>
                                                        <td>{{date_format(date_create($u['blurb']['blurb_end']), 'd-M-Y')}}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div><!-- table-responsive -->
                                    </div><!-- tab-pane -->
                        </div><!-- tab-content -->

                        </div><!-- col-sm-9 -->
                    </div><!-- row -->

                </div><!-- contentpanel -->

            <input type="hidden" id="search_url" value="{{url('')}}">
@endsection

@section('custom-js')
<script type="text/javascript" src="{{asset('js/jquery-ui-1.10.3.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap-timepicker.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="//cdn.datatables.net/plug-ins/725b2a2115b/integration/bootstrap/3/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js"></script>
<script>
    jQuery(document).ready(function(){

        jQuery('#bookmarked_blurbs').DataTable({
            responsive: true,
            order: []
        });

        jQuery('#bookmarked_merchants').DataTable({
            responsive: true,
            order: []
        });

        jQuery('#usage_table').DataTable({
            responsive: true,
            order: []
        });

        var shTable = jQuery('#shTable').DataTable({
            "fnDrawCallback": function(oSettings) {
                jQuery('#shTable_paginate ul').addClass('pagination-active-dark');
            },
            responsive: true
        });
    });
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
