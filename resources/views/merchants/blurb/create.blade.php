@extends('layouts.admin')

@section('page-title', $restaurant->res_name . ' Add New Campaign')

@section('custom-css')

<link href="{{asset('css/dropzone.css')}}" rel="stylesheet">
<link href="{{asset('css/bootstrap-timepicker.min.css')}}" rel="stylesheet">
<style type="text/css">
	.single-dropzone {

	}
  	.dz-image-preview, .dz-file-preview {
	    display: none;
  	}
</style>
@endsection

@section('body-contents')

<section>
    <div class="mainwrapper">

        @include('layouts.sidebar-admin', ['restaurant' => $restaurant])

        <div class="mainpanel">
            <div class="pageheader">
                <div class="media">
                    <div class="pageicon pull-left">
                        <i class="fa fa-tag"></i>
                    </div>
                    <div class="media-body">
                        <ul class="breadcrumb">
                            <li><a href="{{url('dashboard')}}"><i class="glyphicon glyphicon-home"></i></a></li>
                            <li><a href="{{url('campaigns')}}">Campaigns</a></li>
                            <li><a href="{{url('campaigns/'.$campaign->id)}}">{{$campaign->campaign_name}}</a></li>
                            <li>Add New Blurb</li>
                        </ul>
                        <h4>Add New Blurb</h4>
                    </div>
                </div><!-- media -->
            </div><!-- pageheader -->

            <div class="contentpanel">

                <div class="row">
                    <div class="col-sm-12 col-md-4 col-xs-12" style="padding-bottom:30px;max-width:417px;min-width:300px;">
						<div style="border: 1px solid #ccc;">

							<img src="{{env('MERCHANT_URL').'/images/no-coupon.png'}}" class="coupon_image" id="coupon_image" style="width:100%">

							@if(!is_null($restaurant->res_logo))
				            @if($restaurant->photo_location == 'merchant')
                            <img class="img-roundedcircle img-offline img-responsive img-profile" src="{{( is_null($restaurant->res_logo)) ? env('MERCHANT_URL').'/images/nopp.jpg' : env('MERCHANT_URL').'/'.$restaurant->res_logo}}" style="max-width:50px;margin:20px 10px 20px 20px;" alt="">
                            @else
                            <img class="img-roundedcircle img-online" src="{{asset($restaurant->res_logo)}}" style="max-width:50px;margin:20px 10px 20px 20px;" alt="">
                            @endif
				            @else
				            <!-- <div style="max-width:50px;margin:20px 10px 20px 20px;" class="img-roundedcircle square img-offline img-responsive img-profile">
				                <p>@if(!is_null($restaurant->res_name)) {{strtoupper($restaurant->res_name[0])}} @endif</p>
				            </div> -->
				            <img src="{{asset('images/photos/profile.png')}}" class="img-roundedcircle img-offline img-responsive img-profile" style="max-width:50px;margin:20px 10px 20px 20px;" alt="">
				            @endif
							<span style="font-size:16px;">{{$restaurant->res_name}}</span>
							<div class="mb10"></div>
							<span style="margin:20px;font-size:15px;font-weight:bold;"><span id="keyup_blurb_name"></span></span>
							<div style="margin:20px;"><span id="keyup_blurb_desc"></span></div>
							<div class="mb20"></div>
							<!-- <table style="width:100%;margin: 30px 0;">
								<tbody>
									<tr style="border-top:1px solid #ccc;border-bottom:1px solid #ccc;">
										<td style="width:60%;padding:20px;font-weight:bold;">VALID TILL</td>
										<td style="width:40%;text-align:right;padding:20px;"><span id="keyup_blurb_end"></span></td>
									</tr>
								</tbody>
							</table> -->
							<hr style="border-top:.5px solid #ccc;">
							<div style="margin:20px;text-align:center;"><u>TERMS & CONDITIONS</u></div>
							<div style="margin:20px;text-align:justify;"><span id="keyup_blurb_terms"></span></div>
							<div class="mb20"></div>
						</div>
                    </div><!-- col-sm-4 col-md-3 -->

                    <div class="col-sm-12 col-md-8 col-xs-12">
                        <div class="tab-content nopadding noborder">
							<div class="col-sm-12" style="padding-bottom:30px;">
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
								<div class="col-sm-10">
									<label style="padding-bottom: 10px;">Blurb Image *</label>

									{!! Form::open(array('id'=>'blurb-photo', 'files' => true, 'enctype' => 'multipart/form-data', 'url' => 'blurb/upload/'.$campaign->id, 'class' => 'single-dropzone dropzone', 'method'=>'POST')) !!}

										<div class="fallback">
											<input name="file" type="file" />
										</div>

									{!! Form::close() !!}

									<span class="help-block">Must be a square size with at least 500px x 500px.</span>
								</div>
							</div>

							<form method="POST" action="{{url('blurb')}}" accept-charset="UTF-8" class="form-horizontal form-bordered">
							<!-- {!! Form::open(array('url' => 'blurb', 'class' => 'form-horizontal form-bordered')) !!} -->

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">Blurb Title *</label>
                                    <div class="col-sm-8">
                                    <input type="hidden" value="{{csrf_token()}}" name="_token">
                                    	{!! Form::hidden('merchant_id', $campaign->merchant_id, ['required' => 'required', 'class' => 'form-control', 'readonly' => 'readonly']) !!}
                                    	{!! Form::hidden('campaign_id', $campaign->id, ['required' => 'required', 'class' => 'form-control', 'readonly' => 'readonly']) !!}
                                    	{!! Form::hidden('control_no', null, ['readonly' => 'readonly', 'id' => 'control_no', 'class' => 'form-control blurb']) !!}
                                        {!! Form::text('blurb_name', null, ['id' => 'blurb_name_keyup', 'required' => 'required', 'class' => 'form-control blurb']) !!}
                                    </div>
                                </div><!-- form-group -->
								<div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">Category *</label>
                                    <div class="col-sm-8">
                                        <select name="blurb_category_id" id="select-search-hide" data-placeholder="Choose One" class="width300" required />
											<option value="">Choose One</option>
                                            @foreach($blurb_category as $bc)
                                            <option value="{{$bc['id']}}">{{$bc['blurb_cat_name']}}</option>
                                            @endforeach
										</select>
                                    </div>
                                </div><!-- form-group -->

								<div class="form-group">
									<label class="col-sm-2 control-label" style="text-align:left;">Start Date *</label>
									<div class="col-sm-8">
										<div class="input-group">
											{!! Form::text('blurb_start', null, ['required' => 'required', 'id' => 'datepicker', 'placeholder' => 'DD-MMM-YYYY', 'class' => 'form-control']) !!}
											<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
										</div><!-- input-group -->
									</div>
								</div><!-- form-group -->

								<div class="form-group">
									<label class="col-sm-2 control-label" style="text-align:left;">End Date *</label>
									<div class="col-sm-8">
										<div class="input-group">
											{!! Form::text('blurb_end', null, ['required' => 'required' ,'id' => 'datepicker2', 'placeholder' => 'DD-MMM-YYYY', 'class' => 'form-control blurb_end_keyup']) !!}
											<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
										</div><!-- input-group -->
									</div>
								</div><!-- form-group -->

								<div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">Description *</label>
                                    <div class="col-sm-8">
                                        {!! Form::textarea('blurb_desc', null, ['id' => 'blurb_desc_keyup', 'required' => 'required', 'class' => 'form-control', 'maxlength' => 500]) !!}
                                    </div>
                                </div><!-- form-group -->

								<div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">Terms & Conditions *</label>
                                    <div class="col-sm-8">
                                        {!! Form::textarea('blurb_terms', "E.g. Blurb cannot be used with any other offers and is valid for one redemption per transaction. Offer only valid from 12nn to 3pm. Applicable for featured offer only, while stocks last. Restaurants' operating hours may vary. Not applicable for delivery. Forwarded mail and screenshots are not accepted. The privilege may be changed at the discretion of the outlet.", ['id' => 'blurb_terms_keyup', 'required' => 'required', 'class' => 'form-control', 'maxlength' => 2000]) !!}
                                    </div>
                                </div><!-- form-group -->
								<br>
                                <button style="margin-left:15px;" type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{url('campaigns/'.$campaign->id)}}"><button type="button" style="margin-left:15px;" class="btn btn-default">Back</button></a>
                            {!! Form::close() !!}


						</div><!-- tab-content -->

                    </div><!-- col-sm-9 -->
                </div><!-- row -->

            </div><!-- contentpanel -->

        </div>

	</div><!-- mainwrapper -->
</section>
<input type="hidden" id="asset_path" value="{{env('MERCHANT_URL')}}">
<input type="hidden" id="cam_start" value="{{$campaign->cam_start}}">
<input type="hidden" id="cam_end" value="{{$campaign->cam_end}}">
@endsection

@section('custom-js')

<script type="text/javascript" src="{{asset('js/jquery-ui-1.10.3.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/dropzone.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap-timepicker.min.js')}}"></script>
<script type="text/javascript" src="http://www.datejs.com/build/date.js"></script>
<script type="text/javascript">
	$('#blurb_name_keyup').keyup(function(){
		$('#keyup_blurb_name').html($(this).val());
	});

	$('#blurb_desc_keyup').keyup(function(){
		$('#keyup_blurb_desc').html($(this).val());
	});

	$('#blurb_terms_keyup').keyup(function(){
		$('#keyup_blurb_terms').html($(this).val());
	});

	$('#keyup_blurb_terms').html($('#blurb_terms_keyup').val());

	Dropzone.options.blurbPhoto = {
	  init: function() {
	        this.on("success", function(file) {
	            var file = jQuery.parseJSON(file.xhr.responseText);

	            //$('.coupon_image').attr('src', $('#asset_path').val()+'/'+file.blurb.image_path);
	            $('#control_no').val(file.blurb.control_no);
	        });

	        this.on("error", function(file) {
	            alert('Invalid format');
	           // window.location.reload();
	        });
	    }
	};


	// Date Picker
	jQuery('#datepicker').datepicker({
        dateFormat: 'dd-M-yy',
        minDate: new Date($('#cam_start').val()), // 0 days offset = today
        maxDate: new Date($('#cam_end').val()),
        onSelect: function(dateText) {
            $sD = new Date(dateText);
            $("input#datepicker2").datepicker('option', 'minDate', dateText);

        }
    });
	jQuery('#datepicker2').datepicker({
         dateFormat: 'dd-M-yy',
         minDate: new Date($('#cam_start').val()),
         maxDate: new Date($('#cam_end').val()),
         onSelect: function(dateText) {

            $("input#datepicker").datepicker('option', 'maxDate', dateText);
            var date = $(this).val().toString().replace(/-/g,'/');
            var sD = new Date(date);
            $('#keyup_blurb_end').html(sD.toString('dd MMM yyyy').toUpperCase());
        }

    });

	jQuery('#select-search-hide').select2({
        minimumResultsForSearch: -1
    });
</script>

@endsection
