@extends('layouts.admin')

@section('page-title', $restaurant->res_name . ' Profile')

@section('custom-css')

<link href="{{asset('css/dropzone.css')}}" rel="stylesheet">
<link href="{{asset('css/toggles.css')}}" rel="stylesheet">
<link href="{{asset('css/bootstrap-timepicker.min.css')}}" rel="stylesheet">
<link href="{{asset('css/style.datatables.css')}}" rel="stylesheet">
<link href="//cdn.datatables.net/responsive/2.1.0/css/responsive.dataTables.min.css" rel="stylesheet">

@endsection

@section('body-contents')
<section>
    <div class="mainwrapper">

        @include('layouts.sidebar-admin', ['restaurant' => $restaurant])

        <div class="mainpanel">
            <div class="pageheader">
                <div class="media">
                    <div class="pageicon pull-left">
                        <i class="fa fa-cutlery"></i>
                    </div>
                    <div class="media-body">
                        <ul class="breadcrumb">
                            <li><a href="{{url('dashboard')}}"><i class="glyphicon glyphicon-home"></i></a></li>
                            <li>Profile</li>
                        </ul>
                        <h4>Profile</h4>
                    </div>
                </div><!-- media -->
            </div><!-- pageheader -->

            <div class="contentpanel">

                <div class="row">
                    <div class="col-sm-12 col-md-4 col-xs-12" style="padding-bottom:30px;max-width:417px;min-width:300px;">
						<div style="border: 1px solid #ccc;">
							<div class="text-center cover-photo" data-src="{{(! is_null($restaurant->res_logo_background)) ? ($restaurant->bg_photo_location == 'merchant') ? env('MERCHANT_URL').'/uploads/'.$restaurant->merchant_id.'/cover_photo.jpg' : asset('uploads/'.$restaurant->merchant_id.'/cover_photo.jpg') : asset('images/nobg.jpg')}}" style="background:url('{{(! is_null($restaurant->res_logo_background)) ? ($restaurant->bg_photo_location == 'merchant') ? env('MERCHANT_URL').'/uploads/'.$restaurant->merchant_id.'/cover_photo.jpg' : asset('/uploads/'.$restaurant->merchant_id.'/cover_photo.jpg') : asset('images/profile-background.jpg')}}');background-size:cover;">
								<!-- <img src="{{(! is_null($restaurant->res_logo)) ? asset('profile_pictures/'.$restaurant->merchant_id.'/profile_picture.jpg') : asset('images/nopp.jpg')}}" class="img-roundedcircle img-offline img-responsive img-profile" style="max-width:80px;margin-top:45px;" alt="" /> -->
                                @if(!is_null($restaurant->res_logo))
                                @if($restaurant->photo_location == 'merchant')
                                <img src="{{(! is_null($restaurant->res_logo)) ? env('MERCHANT_URL').'/uploads/'.$restaurant->merchant_id.'/profile_picture.jpg' : asset('images/nopp.jpg')}}" class="img-roundedcircle img-offline img-responsive img-profile profile-pic" style="max-width:80px;margin-top:45px;" alt="" />
                                @else
                                <img src="{{(! is_null($restaurant->res_logo)) ? asset('uploads/'.$restaurant->merchant_id.'/profile_picture.jpg')  : asset('images/nopp.jpg')}}" class="img-roundedcircle img-offline img-responsive img-profile profile-pic" style="max-width:80px;margin-top:45px;" alt="" />
                                @endif

                                @else
                                <!-- <span class="square-profile img-roundedcircle img-offline img-responsive img-profile" style="max-width:80px;margin-top:45px;padding-top:10px">
                                    <p>@if(!is_null($restaurant->res_name)) {{strtoupper($restaurant->res_name[0])}} @endif</p>
                                </span> -->
                                <img src="{{asset('images/photos/profile.png')}}" class="profile-pic img-roundedcircle img-offline img-responsive img-profile" style="max-width:80px;margin-top:45px;" alt="">
                                @endif
								<h4 class="profile-name mb5" style="color:#fff;padding-bottom:45px;font-size:16px;margin-top:5px;">{{$merchant->coy_name}}</h4>
							</div><!-- text-center -->
							<div class="mb20"></div>
                            @if(array_key_exists('snapshot_views', $snapshot))

                            <div style="text-align:center;padding:10px 0;"><i class="fa fa-user"></i> {{$snapshot['snapshot_views']}} users bookmarked your restaurant</div>

                            @else

                            <div style="text-align:center;padding:10px 0;"><i class="fa fa-user"></i> 0 users bookmarked your restaurant</div>

                            @endif
                            <div class="mb20"></div>

								<!--<div class="btn-group">
									<button class="btn btn-primary btn-bordered">48 Blurbs Available</button>
								</div>
							<br />-->
							<div style="margin:0px 25px 35px 25px;padding:20px 20px 10px 20px;border:1px solid #ddd;">
								<h5 class="md-title">Details</h5>
								<div class="mb20"></div>
								<table style="width:100%;">
									<tbody>
										<tr style="border-top:1px solid #eee;">
											<td style="width:25%;padding-left:25px;"><i class="fa fa-map-marker fa-lg"></i></td>
											<td style="padding:15px 0;">@if(!is_null($outlet->outlet_name) && $outlet->outlet_name != "") {{$outlet->outlet_name}} <br>@endif {{$outlet->outlet_add}}<br>{{$outlet->outlet_country}} {{$outlet->outlet_zip}}</td>
										</tr>
										<tr style="border-top:1px solid #eee;">
											<td style="width:25%;padding-left:25px;"><i class="fa fa-phone fa-lg"></i></td>
											<td style="padding:15px 0;">{{$outlet->outlet_phone}}</td>
										</tr>
										<tr style="border-top:1px solid #eee;">
											<td style="width:25%;padding-left:25px;"><i class="fa fa-clock-o fa-lg"></i></td>
											<td style="padding:15px 0;">

                                            <?php
$hourss = array(
    'mon' => ($outlet->outlet_mon_active == 0) ? array() : array(date_format(date_create($outlet->outlet_mon_start), "H:i") . ' - ' . date_format(date_create($outlet->outlet_mon_end), "H:i")),
    'tue' => ($outlet->outlet_tue_active == 0) ? array() : array(date_format(date_create($outlet->outlet_tue_start), "H:i") . ' - ' . date_format(date_create($outlet->outlet_tue_end), "H:i")),
    'wed' => ($outlet->outlet_wed_active == 0) ? array() : array(date_format(date_create($outlet->outlet_wed_start), "H:i") . ' - ' . date_format(date_create($outlet->outlet_wed_end), "H:i")),
    'thu' => ($outlet->outlet_thu_active == 0) ? array() : array(date_format(date_create($outlet->outlet_thu_start), "H:i") . ' - ' . date_format(date_create($outlet->outlet_thu_end), "H:i")),
    'fri' => ($outlet->outlet_fri_active == 0) ? array() : array(date_format(date_create($outlet->outlet_fri_start), "H:i") . ' - ' . date_format(date_create($outlet->outlet_fri_end), "H:i")),
    'sat' => ($outlet->outlet_sat_active == 0) ? array() : array(date_format(date_create($outlet->outlet_sat_start), "H:i") . ' - ' . date_format(date_create($outlet->outlet_sat_end), "H:i")),
    'sun' => ($outlet->outlet_sun_active == 0) ? array() : array(date_format(date_create($outlet->outlet_sun_start), "H:i") . ' - ' . date_format(date_create($outlet->outlet_sun_end), "H:i")),
    //'ph' =>  ($outlet->outlet_ph_active == 0) ? array() : array(date_format(date_create($outlet->outlet_ph_start), "H:i").'-'.date_format(date_create($outlet->outlet_ph_end), "H:i")),
);

$store_hours = new StoreHours($hourss);

foreach ($store_hours->hours_this_week(true) as $days => $hours) {

    echo $days . ' : ';
    echo $hours;
    echo "<br>";
}

$close_again = false;
$close_days = [];

foreach ($hourss as $days => $h) {
    if (empty($h)) {
        $close_days[] = ucfirst($days);
        /*echo ucfirst($days) . ' : ';
        echo 'Close';
        echo "<br>";
        $close_again = false;*/

        //echo $close_again;
    }

}

$ctr = 1;
foreach ($close_days as $key => $value) {
    echo $value;
    if ($ctr != count($close_days)) {echo ', ';}
    $ctr++;
}
if (count($close_days) > 0) {echo ' : Close' . "<br>";}

echo ($outlet->outlet_ph_active == 0) ? 'PH : Close' : 'PH : ' . date_format(date_create($outlet->outlet_ph_start), "H:ia") . ' - ' . date_format(date_create($outlet->outlet_ph_end), "H:ia") . "<br>";
?>

                                            </td>
										</tr>
										<tr style="border-top:1px solid #eee;">
											<td style="width:25%;padding-left:25px;"><i class="fa fa-link fa-lg"></i></td>
											<td style="padding:15px 0;">{{$restaurant->res_url}}</td>
										</tr>
										<tr style="border-top:1px solid #eee;">
											<td style="width:25%;padding-left:25px;"><i class="fa fa-tag fa-lg"></i></td>
											<td style="padding:15px 0;">
                                                <?php $ctr = 1?>
												@foreach($restaurant_cuisine as $rc)

													{{ $rc['cuisine']['cuisine_name'] }}@if($ctr != count($restaurant_cuisine)),@endif

                                                    <?php $ctr++;?>

												@endforeach

											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
                    </div><!-- col-sm-4 col-md-3 -->

                    <div class="col-sm-12 col-md-8 col-xs-12">

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs nav-line">
                            <li class="active"><a href="#personal" data-toggle="tab"><strong>Personal</strong></a></li>
                            <li><a href="#company" data-toggle="tab"><strong>Company</strong></a></li>
                            <li><a href="#restaurant" data-toggle="tab"><strong>Restaurant</strong></a></li>
                            <li><a href="#outlets" data-toggle="tab"><strong>Outlets</strong></a></li>
                            <li><a href="#campaigns" data-toggle="tab"><strong>Campaigns</strong></a></li>
                        </ul>

                        @if(session('message'))

	                    <div class="alert alert-success">
	                        <strong>{{session('message')}}</strong>
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
                        <!-- Tab panes -->
                        <div class="tab-content nopadding noborder">
                            <div class="tab-pane active" id="personal">
                                <form method="POST" action="{{url('merchants/'.$merchant->id)}}" class="form-horizontal form-bordered" >

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" style="text-align:left;">Registered on</label>
                                        <div class="col-sm-8">
                                            <p class="control-label" style="text-align:left;">{{date_format(date_create($merchant->created_at), 'd-M-Y H:i:s')}}</p>
                                        </div>
                                    </div><!-- form-group -->

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" style="text-align:left;">Last online on</label>
                                        <div class="col-sm-8">
                                            <p class="control-label" style="text-align:left;">{{date_format(date_create($merchant->last_online), 'd-M-Y H:i:s')}}</p>
                                        </div>
                                    </div><!-- form-group -->

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" style="text-align:left;">Status *</label>
                                        <div class="col-sm-8">
                                            <input type="hidden" name="_method" value="PUT">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <select name="status" id="status" data-placeholder="Choose One" class="width300">
                                                <option value="">Choose One</option>
                                                <option value="1" <?php if ($merchant->status == 1): ?> selected="selected" <?php endif;?>>Approved</option>
                                                <option value="0" <?php if ($merchant->status == 0): ?> selected="selected" <?php endif;?>>Pending Admin Approval</option>
                                                <option value="2" <?php if ($merchant->status == 2): ?> selected="selected" <?php endif;?>>Blocked</option>
                                            </select>
                                        </div>
                                    </div><!-- form-group -->
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" style="text-align:left;">First Name *</label>
                                        <div class="col-sm-8">
                                        {!! Form::hidden('merchant_id', $merchant->id, ['required' => 'required', 'class' => 'form-control'])!!}
                                            {!! Form::text('first_name', $merchant->first_name, ['required' => 'required', 'class' => 'form-control'])!!}

                                        </div>
                                    </div><!-- form-group -->

									<div class="form-group">
                                        <label class="col-sm-2 control-label" style="text-align:left;">Last Name *</label>
                                        <div class="col-sm-8">

                                            {!! Form::text('last_name', $merchant->last_name, ['required' => 'required', 'class' => 'form-control'])!!}

                                        </div>
                                    </div><!-- form-group -->

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" style="text-align:left;" for="disabledinput">Company Email *</label>
                                        <div class="col-sm-8">
                                            <!-- <input type="email" value="" id="disabledinput" class="form-control" disabled="" /> -->

                                            {!! Form::email('email', $merchant->email, ['required' => 'required', 'class' => 'form-control', 'readonly' => ''])!!}

                                            <span class="help-block"><a href="">Contact us</a> to change your email address.</span>
                                        </div>
                                    </div><!-- form-group -->

									<div class="form-group">
                                        <label class="col-sm-2 control-label" style="text-align:left;">Contact Number *</label>
                                        <div class="col-sm-8">
                                            {!! Form::text('coy_phone', $merchant->coy_phone, ['required' => 'required', 'class' => 'form-control'])!!}
                                        </div>
                                    </div><!-- form-group -->

									<div class="form-group">
                                        <label class="col-sm-2 control-label" style="text-align:left;">New Password</label>
                                        <div class="col-sm-8">
                                            <input type="password" placeholder="" class="form-control" name="password" />
                                        </div>
                                    </div><!-- form-group -->

									<div class="form-group">
                                        <label class="col-sm-2 control-label" style="text-align:left;">Confirm Password Again</label>
                                        <div class="col-sm-8">
                                            <input type="password" placeholder="" class="form-control" name="password_confirmation" />
                                        </div>
                                    </div><!-- form-group -->
									<br>
                                    <button type="submit" style="margin-left:15px;" class="btn btn-primary">Update</button>
                               </form>
                            </div><!-- tab-pane -->

                            <div class="tab-pane" id="company">
                                <form method="POST" action="{{url('merchants/company/'.$merchant->id)}}" class="form-horizontal form-bordered" >
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" style="text-align:left;">Company Name *</label>
                                        <div class="col-sm-8">
                                            <input type="hidden" name="_method" value="PUT">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <!-- <input type="text" value="" class="form-control" /> -->
                                            {!! Form::text('coy_name', $merchant->coy_name, ['class' => 'form-control']) !!}
                                        </div>
                                    </div><!-- form-group -->

									<div class="form-group">
                                        <label class="col-sm-2 control-label" style="text-align:left;">Registered Address *</label>
                                        <div class="col-sm-8">
                                            <!-- textarea rows="5" class="form-control" /></textarea> -->
                                            {!! Form::textarea('coy_add', $merchant->coy_add, ['required' => 'required', 'class' => 'form-control']) !!}
                                        </div>
                                    </div><!-- form-group -->

									<div class="form-group">
                                        <label class="col-sm-2 control-label" style="text-align:left;" for="disabledinput">Country *</label>
                                        <div class="col-sm-8">
                                            <!-- <input type="text" value="Singapore" id="disabledinput" class="form-control" disabled="" /> -->
                                            {!! Form::text('coy_country', 'Singapore', ['required' => 'required', 'class' => 'form-control', 'readonly' => 'readonly']) !!}
                                        </div>
                                    </div><!-- form-group -->

									<div class="form-group">
                                        <label class="col-sm-2 control-label" style="text-align:left;">Postal Code *</label>
                                        <div class="col-sm-8">
                                            <!-- <input type="text" value="049514" class="form-control" /> -->
                                            {!! Form::number('coy_zip', $merchant->coy_zip, ['required' => 'required', 'class' => 'form-control']) !!}
                                        </div>
                                    </div><!-- form-group -->

									<div class="form-group">
                                        <label class="col-sm-2 control-label" style="text-align:left;">Company Phone Number *</label>
                                        <div class="col-sm-8">
                                            {!! Form::text('coy_phone', $merchant->coy_phone, ['required' => 'required', 'class' => 'form-control']) !!}
                                        </div>
                                    </div><!-- form-group -->

									<div class="form-group">
                                        <label class="col-sm-2 control-label" style="text-align:left;">Company Website URL *</label>
                                        <div class="col-sm-8">
                                            {!! Form::text('coy_url', $merchant->coy_url, ['class' => 'form-control']) !!}
                                        </div>
                                    </div><!-- form-group -->

									<br>
                                    <button style="margin-left:15px;" type="submit" class="btn btn-primary">Update</button>

                                </form>

                            </div><!-- tab-pane -->

                            <div class="tab-pane" id="restaurant">
								<div class="col-sm-12" style="padding-bottom:30px;">
									<div class="col-sm-5">
										<h4 class="md-title">Restaurant Logo *</h4>
										<!-- <form action="files" class="dropzone"> -->
                                        {!! Form::open(array('id'=>'profile-picture', 'enctype' => 'multipart/form-data', 'url' => 'merchants/restaurant/upload-pp/'.$restaurant->id, 'class' => 'dropzone form-horizontal form-bordered', 'method'=>'POST')) !!}
                                            {!! Form::hidden('merchant_id', $merchant->id, ['required' => 'required', 'class' => 'form-control'])!!}
                                            <div class="fallback">
												<input name="file" type="file" />
											</div>

										{!! Form::close() !!}

										<span class="help-block">Must be a square size with at least 128px x 128px.</span>
									</div>
									<div class="col-sm-5">
										<h4 class="md-title">Logo Background *</h4>

                                        {!! Form::open(array('id'=>'cover-photo', 'enctype' => 'multipart/form-data', 'url' => 'merchants/restaurant/upload-cp/'.$restaurant->id, 'class' => 'dropzone form-horizontal form-bordered', 'method'=>'POST')) !!}
                                            {!! Form::hidden('merchant_id', $merchant->id, ['required' => 'required', 'class' => 'form-control'])!!}
                                            <div class="fallback">
												<input name="file" type="file" multiple />
											</div>

										{!! Form::close() !!}

										<span class="help-block">Must be at least 500px x 500px.</span>
									</div>
								</div>

                                <form method="POST" action="{{url('merchants/restaurant/'.$restaurant->id)}}" class="form-horizontal form-bordered" >

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" style="text-align:left;">Restaurant Name *</label>
                                        <div class="col-sm-8">
                                            <input type="hidden" name="_method" value="PUT">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            {!! Form::hidden('merchant_id', $merchant->id, ['required' => 'required', 'class' => 'form-control'])!!}
                                            {!! Form::hidden('res_id', $restaurant->id, ['class' => 'form-control']) !!}
                                            {!! Form::text('res_name', $restaurant->res_name, ['class' => 'form-control']) !!}
                                        </div>
                                    </div><!-- form-group -->

									<div class="form-group">
                                        <label class="col-sm-2 control-label" style="text-align:left;">Restaurant Website URL *</label>
                                        <div class="col-sm-8">
                                            <!-- <input type="text" value="www.starbucks.com.sg" class="form-control" /> -->
                                            {!! Form::text('res_url', $restaurant->res_url, ['class' => 'form-control']) !!}
                                        </div>
                                    </div><!-- form-group -->

									<div class="form-group">
                                        <label class="col-sm-2 control-label" style="text-align:left;">Restaurant Cuisine *</label>
                                        <div class="col-sm-8">
                                            <select name="res_cuisine[]" id="select-multi" data-placeholder="Choose At Least One" multiple class="width300" style="width:100%;">
												<optgroup label="Choose At Least One"></optgroup>
                                                <option></option>
    												@foreach($cuisines as $c)

    												<option value="{{$c['id']}}" @if(in_array($c['id'], $cuisines_id)) selected="selected" @endif>{{$c['cuisine_name']}}</option>

    												@endforeach

											</select>
                                        </div>
                                    </div><!-- form-group -->
                                   	<br>
                                    <button style="margin-left:15px;" type="submit" class="btn btn-primary">Update</button>

                                </form>

							</div><!-- tab-pane -->

							<div class="tab-pane" id="outlets">
								<p>Here will contain the details of all your other outlets (including the main outlet).</p>
								<hr>
								<h4 class="md-title">Main Outlet</h4>
                                <form method="POST" action="{{url('merchants/outlet/'.$outlet->id)}}" class="form-horizontal form-bordered" >


								   <div class="form-group">
                                        <label class="col-sm-2 control-label" style="text-align:left;">Outlet Name</label>
                                        <div class="col-sm-8">
                                            <input type="hidden" name="from_main" value='1'>
                                            <input type="hidden" name="_method" value="PUT">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            {!! Form::hidden('main', $outlet->main, ['id' => 'disabledinput', 'readonly' => 'readonly', 'class' => 'form-control']) !!}
											{!! Form::hidden('merchant_id', $merchant->id, ['required' => 'required', 'class' => 'form-control'])!!}

                                            <!-- <input type="text" value="Starbucks @ Northpoint" title="This is to differentiate from outlet's name." data-toggle="tooltip" data-trigger="hover" class="form-control tooltips" /> -->
											{!! Form::text('outlet_name', $outlet->outlet_name, ['data-trigger' => 'hover', 'data-toggle' => 'tooltip', 'title' => "This is to differentiate from outlet's name.", 'class' => 'form-control tooltips']) !!}
                                        </div>
                                    </div><!-- form-group -->

									<div class="form-group">
                                        <label class="col-sm-2 control-label" style="text-align:left;">Outlet Address *</label>
                                        <div class="col-sm-8">
                                            <!-- <textarea rows="5" placeholder="" class="form-control" />63 Chulia Street OCBC Centre East #01/01A01B</textarea> -->
                                            {!! Form::textarea('outlet_add', $outlet->outlet_add, ['required' => 'required', 'class' => 'form-control', 'rows' => '5']) !!}
                                        </div>
                                    </div><!-- form-group -->

									<div class="form-group">
                                        <label class="col-sm-2 control-label" style="text-align:left;" for="disabledinput">Country *</label>
                                        <div class="col-sm-8">
                                            <!-- <input type="text" value="Singapore" id="disabledinput" class="form-control" disabled="" /> -->
                                            {!! Form::text('outlet_country', 'Singapore', ['id' => 'disabledinput', 'readonly' => 'readonly', 'class' => 'form-control']) !!}
                                        </div>
                                    </div><!-- form-group -->

									<div class="form-group">
                                        <label class="col-sm-2 control-label" style="text-align:left;">Outlet's Postal Code *</label>
                                        <div class="col-sm-8">
                                            <!-- <input type="text" value="049514" class="form-control" /> -->
                                            {!! Form::number('outlet_zip', $outlet->outlet_zip, ['required' => 'required', 'class' => 'form-control']) !!}
                                        </div>
                                    </div><!-- form-group -->

									<div class="form-group">
                                        <label class="col-sm-2 control-label" style="text-align:left;">Outlet's Phone Number *</label>
                                        <div class="col-sm-8">
                                            <!-- <input type="text" value="+6564620097" class="form-control" /> -->
                                            {!! Form::text('outlet_phone', $outlet->outlet_phone, ['class' => 'form-control']) !!}
                                        </div>
                                    </div><!-- form-group -->

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" style="text-align:left;">Timezone *</label>
                                        <div class="col-sm-8">
                                            <!-- <input type="text" value="GMT +08:00 (Singapore)" id="disabledinput" class="form-control" disabled="" /> -->
                                            {!! Form::text('outlet_timezone', 'GMT +08:00 (Singapore)', ['id' => 'disabledinput', 'readonly' => 'readonly', 'class' => 'form-control']) !!}
                                        </div>
                                    </div><!-- form-group -->

                                    <div class="form-group openinghours-form">
                                        <label class="col-xs-12 col-sm-12 control-label" style="text-align:left;padding-bottom:5px;">Outlet's Opening Hours *</label>
                                        <label class="col-xs-12 col-sm-2 control-label" style="text-align:left;"></label>
                                        <div class="col-xs-1" style="width:50px;padding-top:12px;">
                                            <p>Mon</p>
                                        </div>
                                        <div class="col-xs-2 col-sm-2 col-md-2" style="max-width:80px;">
                                            <div class="toggle toggle-primary" data-toggle-on="true" id="mon-active-toggle"></div>
                                            <input name="outlet_mon_active" value="{{$outlet->outlet_mon_active}}" type="hidden" class="form-control mon-active-toggle" />
                                        </div>
                                        <div class="col-xs-3 col-sm-2">
                                        	<div class="bootstrap-timepicker">
												<!-- <input id="timepicker-mon-start-1" type="text" class="form-control" value="21:00"/> -->
												{!! Form::text('outlet_mon_start', date_format(date_create($outlet->outlet_mon_start), 'H:ia'), ['id' => 'timepicker-mon-start-1', 'class' => 'toggle-timepicker-mon-active-toggle form-control']) !!}
											</div>
										</div>
										<div class="col-xs-1" style="width:40px;padding-top:12px;">
                                            <p style="text-align:center;">to</p>
                                        </div>
										<div class="col-xs-3 col-sm-2">
											<div class="bootstrap-timepicker">
												<!-- <input id="timepicker-mon-end-1" type="text" class="form-control" value="21:00"/> -->
												{!! Form::text('outlet_mon_end', date_format(date_create($outlet->outlet_mon_end), 'H:ia'), ['id' => 'timepicker-mon-end-1', 'class' => 'toggle-timepicker-mon-active-toggle form-control']) !!}
											</div>
										</div>
                                    </div><!-- form-group -->

									<div class="form-group openinghours-form">
                                        <label class="col-xs-12 col-sm-2 control-label" style="text-align:left;"></label>

                                        <div class="col-xs-1" style="width:50px;padding-top:12px;">
                                            <p>Tue</p>
                                        </div>
                                        <div class="col-xs-2 col-sm-2 col-md-2" style="max-width:80px;">
                                            <div class="toggle toggle-primary" id="tue-active-toggle"></div>
                                            <input name="outlet_tue_active" value="{{$outlet->outlet_tue_active}}" type="hidden" class="form-control tue-active-toggle" />
                                        </div>
                                        <div class="col-xs-3 col-sm-2">
											<!-- <div class="bootstrap-timepicker"><input id="timepicker-tue-start-1" type="text" class="form-control" value="07:00"/></div> -->
                                            <div class="bootstrap-timepicker">{!! Form::text('outlet_tue_start', date_format(date_create($outlet->outlet_tue_start), 'H:ia'), ['id' => 'timepicker-tue-start-1', 'class' => 'toggle-timepicker-tue-active-toggle form-control']) !!}</div>
										</div>
										<div class="col-xs-1" style="width:40px;padding-top:12px;">
                                            <p style="text-align:center;">to</p>
                                        </div>
										<div class="col-xs-3 col-sm-2">
											<div class="bootstrap-timepicker">{!! Form::text('outlet_tue_end', date_format(date_create($outlet->outlet_tue_end), 'H:ia'), ['id' => 'timepicker-tue-end-1', 'class' => 'toggle-timepicker-tue-active-toggle form-control']) !!}</div>
										</div>
                                    </div><!-- form-group -->

									<div class="form-group openinghours-form">
                                        <label class="col-xs-12 col-sm-2 control-label" style="text-align:left;"></label>

                                        <div class="col-xs-1" style="width:50px;padding-top:12px;">
                                            <p>Wed</p>
                                        </div>
                                        <div class="col-xs-2 col-sm-2 col-md-2" style="max-width:80px;">
                                            <div class="toggle toggle-primary" id="wed-active-toggle"></div>
                                            <input name="outlet_wed_active" value="{{$outlet->outlet_wed_active}}" type="hidden" class="form-control wed-active-toggle" />
                                        </div>
                                        <div class="col-xs-3 col-sm-2">
											<div class="bootstrap-timepicker">{!! Form::text('outlet_wed_start', date_format(date_create($outlet->outlet_wed_start), 'H:ia'), ['id' => 'timepicker-wed-start-1', 'class' => 'toggle-timepicker-wed-active-toggle form-control']) !!}</div>
										</div>
										<div class="col-xs-1" style="width:40px;padding-top:12px;">
                                            <p style="text-align:center;">to</p>
                                        </div>
										<div class="col-xs-3 col-sm-2">
											<div class="bootstrap-timepicker">{!! Form::text('outlet_wed_end', date_format(date_create($outlet->outlet_wed_end), 'H:ia'), ['id' => 'timepicker-wed-end-1', 'class' => 'toggle-timepicker-wed-active-toggle form-control']) !!}</div>
										</div>
                                    </div><!-- form-group -->

									<div class="form-group openinghours-form">
                                        <label class="col-xs-12 col-sm-2 control-label" style="text-align:left;"></label>

                                        <div class="col-xs-1" style="width:50px;padding-top:12px;">
                                            <p>Thu</p>
                                        </div>
                                        <div class="col-xs-2 col-sm-2 col-md-2" style="max-width:80px;">
                                            <div class="toggle toggle-primary" id="thu-active-toggle"></div>
                                            <input name="outlet_thu_active" value="{{$outlet->outlet_thu_active}}" type="hidden" class="form-control thu-active-toggle" />
                                        </div>
                                        <div class="col-xs-3 col-sm-2">
											<div class="bootstrap-timepicker">{!! Form::text('outlet_thu_start', date_format(date_create($outlet->outlet_thu_start), 'H:ia'), ['id' => 'timepicker-thu-start-1', 'class' => 'toggle-timepicker form-control']) !!}</div>
										</div>
										<div class="col-xs-1" style="width:40px;padding-top:12px;">
                                            <p style="text-align:center;">to</p>
                                        </div>
										<div class="col-xs-3 col-sm-2">
											<div class="bootstrap-timepicker">{!! Form::text('outlet_thu_end', date_format(date_create($outlet->outlet_thu_end), 'H:ia'), ['id' => 'timepicker-thu-end-1', 'class' => 'toggle-timepicker form-control']) !!}</div>
										</div>
                                    </div><!-- form-group -->

									<div class="form-group openinghours-form">
                                        <label class="col-xs-12 col-sm-2 control-label" style="text-align:left;"></label>

                                        <div class="col-xs-1" style="width:50px;padding-top:12px;">
                                            <p>Fri</p>
                                        </div>
                                        <div class="col-xs-2 col-sm-2 col-md-2" style="max-width:80px;">
                                            <div class="toggle toggle-primary" id="fri-active-toggle"></div>
                                            <input name="outlet_fri_active" value="{{$outlet->outlet_fri_active}}" type="hidden" class="form-control fri-active-toggle" />
                                        </div>
                                        <div class="col-xs-3 col-sm-2">
											<div class="bootstrap-timepicker">{!! Form::text('outlet_fri_start', date_format(date_create($outlet->outlet_fri_start), 'H:ia'), ['id' => 'timepicker-fri-start-1', 'class' => 'toggle-timepicker-fri-active-toggle form-control']) !!}</div>
										</div>
										<div class="col-xs-1" style="width:40px;padding-top:12px;">
                                            <p style="text-align:center;">to</p>
                                        </div>
										<div class="col-xs-3 col-sm-2">
											<div class="bootstrap-timepicker">{!! Form::text('outlet_fri_end', date_format(date_create($outlet->outlet_fri_end), 'H:ia'), ['id' => 'timepicker-fri-end-1', 'class' => 'toggle-timepicker-fri-active-toggle form-control']) !!}</div>
										</div>
                                    </div><!-- form-group -->

									<div class="form-group openinghours-form">
                                        <label class="col-xs-12 col-sm-2 control-label" style="text-align:left;"></label>

                                        <div class="col-xs-1" style="width:50px;padding-top:12px;">
                                            <p>Sat</p>
                                        </div>
                                        <div class="col-xs-2 col-sm-2 col-md-2" style="max-width:80px;">
                                            <div class="toggle toggle-primary" id="sat-active-toggle"></div>
                                            <input name="outlet_sat_active" value="{{$outlet->outlet_sat_active}}" type="hidden" class="form-control sat-active-toggle" />
                                        </div>
                                        <div class="col-xs-3 col-sm-2">
											<div class="bootstrap-timepicker">{!! Form::text('outlet_sat_start', date_format(date_create($outlet->outlet_sat_start), 'H:ia'), ['id' => 'timepicker-sat-start-1', 'class' => 'toggle-timepicker form-control']) !!}</div>
										</div>
										<div class="col-xs-1" style="width:40px;padding-top:12px;">
                                            <p style="text-align:center;">to</p>
                                        </div>
										<div class="col-xs-3 col-sm-2">
											<div class="bootstrap-timepicker">{!! Form::text('outlet_sat_end', date_format(date_create($outlet->outlet_sat_end), 'H:ia'), ['id' => 'timepicker-sat-end-1', 'class' => 'toggle-timepicker form-control']) !!}</div>
										</div>
                                    </div><!-- form-group -->

									<div class="form-group openinghours-form">
                                        <label class="col-xs-12 col-sm-2 control-label" style="text-align:left;"></label>

                                        <div class="col-xs-1" style="width:50px;padding-top:12px;">
                                            <p>Sun</p>
                                        </div>
                                        <div class="col-xs-2 col-sm-2 col-md-2" style="max-width:80px;">
                                            <div class="toggle toggle-primary" id="sun-active-toggle"></div>
                                            <input name="outlet_sun_active" value="{{$outlet->outlet_sun_active}}" type="hidden" class="form-control sun-active-toggle" />
                                        </div>
                                        <div class="col-xs-3 col-sm-2">
											<div class="bootstrap-timepicker">{!! Form::text('outlet_sun_start', date_format(date_create($outlet->outlet_sun_start), 'H:ia'), ['id' => 'timepicker-sun-start-1', 'class' => 'toggle-timepicker form-control']) !!}</div>
										</div>
										<div class="col-xs-1" style="width:40px;padding-top:12px;">
                                            <p style="text-align:center;">to</p>
                                        </div>
										<div class="col-xs-3 col-sm-2">
											<div class="bootstrap-timepicker">{!! Form::text('outlet_sun_end', date_format(date_create($outlet->outlet_sun_end), 'H:ia'), ['id' => 'timepicker-sun-end-1', 'class' => 'toggle-timepicker form-control']) !!}</div>
										</div>
                                    </div><!-- form-group -->

                                    <div class="form-group openinghours-form">
                                        <label class="col-xs-12 col-sm-2 control-label" style="text-align:left;"></label>

                                        <div class="col-xs-1" style="width:50px;padding-top:12px;">
                                            <p>PH</p>
                                        </div>
                                        <div class="col-xs-2 col-sm-2 col-md-2" style="max-width:80px;">
                                            <div class="toggle toggle-primary" id="ph-active-toggle"></div>
                                            <input name="outlet_ph_active" value="{{$outlet->outlet_ph_active}}" type="hidden" class="form-control ph-active-toggle" />
                                        </div>
                                        <div class="col-xs-3 col-sm-2">
                                            <div class="bootstrap-timepicker">{!! Form::text('outlet_ph_start', date_format(date_create($outlet->outlet_ph_start), 'H:ia'), ['id' => 'timepicker-ph-start-1', 'class' => 'toggle-timepicker form-control']) !!}</div>
                                        </div>
                                        <div class="col-xs-1" style="width:40px;padding-top:12px;">
                                            <p style="text-align:center;">to</p>
                                        </div>
                                        <div class="col-xs-3 col-sm-2">
                                            <div class="bootstrap-timepicker">{!! Form::text('outlet_ph_end', date_format(date_create($outlet->outlet_ph_end), 'H:ia'), ['id' => 'timepicker-ph-end-1', 'class' => 'toggle-timepicker form-control']) !!}</div>
                                        </div>
                                    </div><!-- form-group -->
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
								<hr>
								<h4 class="md-title">Other Outlets</h4>
								<hr>
								<a href="{{url('outlets/'.$merchant->id.'/create')}}"><button class="btn btn-primary"><i class="fa fa-plus"></i> Add Other Outlet</button></a>
								<hr>
								<table id="outleTable" class="table table-striped table-bordered responsive">
	                                <thead class="">
	                                    <tr>
											<th>Outlet Name</th>
											<th>Address</th>
											<th>Phone Number</th>
											<th>Opening Hours</th>
											<th></th>
	                                    </tr>
	                                </thead>

	                                <tbody>

                                        @foreach($outlets as $o)

                                        <tr>
	                                        <td>{{$o['outlet_name']}}</td>
                                            <td>{{$o['outlet_add']}}</td>
                                            <td>{{$o['outlet_phone']}}</td>
											<td>
                                                <?php
$hourss = array(
    'mon' => ($o['outlet_mon_active'] == 0) ? array() : array(date_format(date_create($o['outlet_mon_start']), "H:i") . '-' . date_format(date_create($o['outlet_mon_end']), "H:i")),
    'tue' => ($o['outlet_tue_active'] == 0) ? array() : array(date_format(date_create($o['outlet_tue_start']), "H:i") . '-' . date_format(date_create($o['outlet_tue_end']), "H:i")),
    'wed' => ($o['outlet_wed_active'] == 0) ? array() : array(date_format(date_create($o['outlet_wed_start']), "H:i") . '-' . date_format(date_create($o['outlet_wed_end']), "H:i")),
    'thu' => ($o['outlet_thu_active'] == 0) ? array() : array(date_format(date_create($o['outlet_thu_start']), "H:i") . '-' . date_format(date_create($o['outlet_thu_end']), "H:i")),
    'fri' => ($o['outlet_fri_active'] == 0) ? array() : array(date_format(date_create($o['outlet_fri_start']), "H:i") . '-' . date_format(date_create($o['outlet_fri_end']), "H:i")),
    'sat' => ($o['outlet_sat_active'] == 0) ? array() : array(date_format(date_create($o['outlet_sat_start']), "H:i") . '-' . date_format(date_create($o['outlet_sat_end']), "H:i")),
    'sun' => ($o['outlet_sun_active'] == 0) ? array() : array(date_format(date_create($o['outlet_sun_start']), "H:i") . '-' . date_format(date_create($o['outlet_sun_end']), "H:i")),
    //'ph' =>  ($o['outlet_ph_active'] == 0) ? array() : array(date_format(date_create($o['outlet_ph_start']), "H:i").'-'.date_format(date_create($o['outlet_ph_end']), "H:i")),
);

$store_hours = new StoreHours($hourss);

foreach ($store_hours->hours_this_week(true) as $days => $hours) {

    echo $days . ' : ';
    echo $hours;
    echo "<br>";
}

$close_again = false;
$close_days = [];

foreach ($hourss as $days => $h) {
    if (empty($h)) {
        $close_days[] = ucfirst($days);
    }

}

$ctr = 1;
foreach ($close_days as $key => $value) {
    echo $value;
    if ($ctr != count($close_days)) {echo ', ';}
    $ctr++;
}
if (count($close_days) > 0) {echo ' : Close' . "<br>";}

echo ($outlet->outlet_ph_active == 0) ? 'PH : Close' : 'PH : ' . date_format(date_create($outlet->outlet_ph_start), "H:ia") . ' - ' . date_format(date_create($outlet->outlet_ph_end), "H:ia") . "<br>";
?>
                                            </td>
											<td class="table-action">
												<a href="{{url('outlets/edit/'.$o['id'].'/'.$o['merchant_id'])}}" data-toggle="tooltip" title="Edit" class="tooltips"><i class="fa fa-pencil"></i></a>
                                                <a href="#deleteOutletModal" data-outlet-id="{{$o['id']}}" data-outlet-name="{{$o['outlet_name']}}" data-target="#deleteOutletModal" data-toggle="modal" title="Delete" class="tooltips"><i class="fa fa-trash-o"></i></a>
											</td>
	                                    </tr>

                                        @endforeach

	                                </tbody>
                    			</table>
							</div><!-- tab-pane -->
                            <div class="tab-pane" id="campaigns">
                                <a href="{{url('merchants/'.$merchant_id.'/create-campaign')}}"><button class="btn btn-primary"><i class="fa fa-plus"></i> Add New Campaign</button></a>
                                <hr>
                                <table id="campaigns_table" class="table table-striped table-bordered responsive">
                                    <thead class="">
                                        <tr>
                                            <th>Campaign Name</th>
                                            <th>Status</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>No. of Blurbs</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($campaigns as $campaign)
                                        <tr>
                                            <td><a href="{{url('/campaigns/'.$campaign['id'])}}">{{$campaign['campaign_name']}}</a></td>
                                            <td>
                                                @if($campaign['cam_status'] == 'Approved')
                                                <span class="text-success">
                                                @elseif($campaign['cam_status'] == 'Draft')
                                                <span class="text-info">
                                                @elseif($campaign['cam_status'] == 'Live')
                                                <span class="text-success">
                                                @elseif($campaign['cam_status'] == 'Rejected')
                                                <span class="text-danger">
                                                @elseif($campaign['cam_status'] == 'Expired')
                                                <span class="text-muted">
                                                @else
                                                <span class="text-warning">
                                                @endif
                                                <strong>{{$campaign['cam_status']}}</strong></span></td>
                                            <td>{{date_format(date_create($campaign['cam_start']), 'd-M-Y')}}</td>
                                            <td>{{date_format(date_create($campaign['cam_end']), 'd-M-Y')}}</td>
                                            <td>{{count($campaign['blurb'])}}</td>
                                            <td class="table-action">
                                                @if($campaign['cam_status'] == 'Rejected' || $campaign['cam_status'] == 'Draft')

                                                <a href="{{url('merchants/'.$campaign['id'].'/edit-campaign')}}" data-toggle="tooltip" title="Edit" class="tooltips"><i class="fa fa-pencil"></i></a>

                                                @else

                                                <a href="{{url('merchants/'.$campaign['id'].'/edit-campaign')}}" data-toggle="tooltip" title="View" class="tooltips"><i class="fa fa-eye"></i></a>

                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div><!-- tab-pane -->
                        </div><!-- tab-content -->
                    </div><!-- col-sm-9 -->
                </div><!-- row -->
            </div><!-- contentpanel -->
        </div>
    </div><!-- mainwrapper -->
</section>
<div class="modal fade deleteOutletModal" id="deleteOutletModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete Outlet</h4>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this outlet?
      </div>
      <div class="modal-footer">

        {!! Form::open(array('url' => '', 'class' => 'form-horizontal form-bordered delete-outlet-form')) !!}
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        <input name="_method" type="hidden" value="DELETE">
        <input type="hidden" id="outletId" name="outlet_id">
        <button class="btn btn-primary delete-outlet-yes">Yes</button>

        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
<input type="hidden" id="asset_path" value="{{asset('')}}">
@endsection

@section('custom-js')

<script type="text/javascript">
jQuery('#status').select2({
        minimumResultsForSearch: -1
    });
    $('.deleteOutletModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var outlet_id = button.data('outlet-id');
        var outlet_name = button.data('outlet-name');
        var modal = $(this);
        modal.find('.modal-title').text('Delete ' + outlet_name);
        modal.find('.modal-footer #outletId').val(outlet_id);
        $('.delete-outlet-form').attr('action', '/outlets/'+outlet_id);
    });

    $(".toggle").toggle(
        function() {

            if($("."+this.id).val() == 0) {
                $("."+this.id).val(1);
            }

            else {
                $("."+this.id).val(0);
            }
        },
        function() {

            if($("."+this.id).val() == 1) {
                $("."+this.id).val(0);
            }

            else {
                $("."+this.id).val(1);
            }
        }
    );
    $(function() {
      //for bootstrap 3 use 'shown.bs.tab' instead of 'shown' in the next line
      $('a[data-toggle="tab"]').on('click', function (e) {
        //save the latest tab; use cookies if you like 'em better:
        localStorage.setItem('lastTab', $(e.target).attr('href'));
      });

      //go to the latest tab, if it exists:
      var lastTab = localStorage.getItem('lastTab');

      if (lastTab) {
          $('a[href="'+lastTab+'"]').click();
      }
    });

    jQuery(document).ready(function(){

        jQuery('#outleTable').DataTable({
            responsive: true
        });

        jQuery('#campaigns_table').DataTable({
            responsive: true
        });

        var shTable = jQuery('#shTable').DataTable({
            "fnDrawCallback": function(oSettings) {
                jQuery('#shTable_paginate ul').addClass('pagination-active-dark');
            },
            responsive: true
        });
    });
</script>
<script type="text/javascript" src="{{asset('js/dropzone.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/toggles.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap-timepicker.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="//cdn.datatables.net/plug-ins/725b2a2115b/integration/bootstrap/3/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="{{asset('js/jquery.prettyPhoto.js')}}"></script>
<script type="text/javascript" src="{{asset('js/holder.js')}}"></script>
<script type="text/javascript" src="{{asset('js/merchant/profile.js')}}"></script>


@endsection
