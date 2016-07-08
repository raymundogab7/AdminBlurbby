@extends('layouts.admin')



@if($campaign->cam_status == 'Draft' && $campaign->cam_status == 'Rejected')
@section('page-title', $restaurant->res_name . ' Edit Blurb')
@else
@section('page-title', $restaurant->res_name . ' View Blurb')
@endif

@section('custom-css')

<link href="{{asset('css/dropzone.css')}}" rel="stylesheet">
<link href="{{asset('css/bootstrap-timepicker.min.css')}}" rel="stylesheet">

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
                            @if($campaign->cam_status == 'Draft' || $campaign->cam_status == 'Rejected')
                            <li>Edit Blurb</li>
                            @else
                            <li>View Blurb</li>
                            @endif
                        </ul>
                        @if($campaign->cam_status == 'Draft' || $campaign->cam_status == 'Rejected')
                        <h4>Edit Blurb</h4>
                        @else
                        <h4>View Blurb</h4>
                        @endif
                        
                    </div>
                </div><!-- media -->
            </div><!-- pageheader -->
            
            <div class="contentpanel">
                
                <div class="row">
                    <div class="col-sm-12 col-md-4 col-xs-12" style="padding-bottom:30px;max-width:417px;min-width:300px;">
						<div style="border: 1px solid #ccc;">
							                    
                            @if(!is_null($blurb->blurb_logo))
                            <img class="blurb-photo" src="{{env('MERCHANT_URL').'/'.$blurb->blurb_logo}}" style="width:100%"> 

                            @else
                            <img src="{{env('MERCHANT_URL').'/images/no-coupon.png'}}" style="width:100%"> 
                            @endif

                            @if(!is_null($restaurant->res_logo))
                            <img class="img-roundedcircle img-offline img-responsive img-profile" src="{{( is_null($restaurant->res_logo)) ? env('MERCHANT_URL').'/images/nopp.jpg' : env('MERCHANT_URL').'/uploads/'.$restaurant->merchant_id.'/profile_picture.jpg'}}" style="max-width:50px;margin:20px 10px 20px 20px;" alt="">

                            @else
                            <!-- <div style="max-width:50px;margin:20px 10px 20px 20px;" class="img-roundedcircle square img-offline img-responsive img-profile">  
                                <p>@if(!is_null($restaurant->res_name)) {{strtoupper($restaurant->res_name[0])}} @endif</p>
                            </div> -->
                            <img src="{{asset('images/photos/profile.png')}}" class="img-roundedcircle img-offline img-responsive img-profile" style="max-width:50px;margin:20px 10px 20px 20px;" alt="">
                            @endif
                            <span style="font-size:16px;">{{$restaurant->res_name}}</span>
							<div class="mb10"></div> 
							<span style="margin:20px;font-size:15px;font-weight:bold;">{{$blurb->blurb_name}}</span>
							<div style="margin:20px;">{{$blurb->blurb_desc}}</div>
							<div class="mb20"></div>
							<table style="width:100%;margin: 30px 0;">
								<tbody>
									<tr style="border-top:1px solid #ccc;border-bottom:1px solid #ccc;">
										<td style="width:60%;padding:20px;font-weight:bold;">VALID TILL</td>
										<td style="width:40%;text-align:right;padding:20px;">{{date_format(date_create($blurb->blurb_end), 'd M Y')}}</td>
									</tr>
								</tbody>
							</table>
							<div style="margin:20px;text-align:center;"><u>TERMS & CONDITIONS</u></div>
							<div style="margin:20px;text-align:justify;">{{$blurb->blurb_terms}}</div>
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
                                @if($blurb->blurb_status == 'Rejected' || $blurb->blurb_status == 'Created')
								<div class="col-sm-10">
									<label style="padding-bottom: 10px;">Blurb Image *</label>
									{!! Form::open(array('id'=>'blurb-photo', 'enctype' => 'multipart/form-data', 'url' => 'blurb/updateLogo/'.$blurb->id.'/'.$campaign->id, 'class' => 'dropzone form-horizontal form-bordered', 'method'=>'POST')) !!}
										<div class="fallback">
											<input name="file" type="file" id="disabledinput" disabled="" />
										</div>
									{!! Form::close() !!}
									<span class="help-block">Must be a square size with at least 500px x 500px.</span>
								</div>
                                @endif
							</div>
                            @if($blurb->blurb_status == 'Approved')
							@include('blurb._approved', ['blurb' => $blurb])
                            @elseif($blurb->blurb_status == 'Pending Approval')
                            @include('blurb._pending_approval', ['blurb' => $blurb])
                            @elseif($blurb->blurb_status == 'Created')
                            @include('blurb._draft', ['blurb' => $blurb])
                            @elseif($blurb->blurb_status == 'Rejected')
                            @include('blurb._rejected', ['blurb' => $blurb])
                            @elseif($blurb->blurb_status == 'Live')
                            @include('blurb._live', ['blurb' => $blurb])
                            @elseif($blurb->blurb_status == 'Expired')
                            @include('blurb._expired', ['blurb' => $blurb])
                            @endif
						</div><!-- tab-content -->
                    </div><!-- col-sm-9 -->
                </div><!-- row -->  
            
            </div><!-- contentpanel -->
            
        </div>
    </div><!-- mainwrapper -->
</section>

@endsection

@section('custom-js')

<script type="text/javascript" src="{{asset('js/jquery-ui-1.10.3.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/dropzone.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap-timepicker.min.js')}}"></script>

<script type="text/javascript">

    // Date Picker
    jQuery('#datepicker').datepicker({ 
        dateFormat: 'dd-M-yy',
        minDate: 0, // 0 days offset = today
        onSelect: function(dateText) {
            $sD = new Date(dateText);
            $("input#datepicker2").datepicker('option', 'minDate', dateText);
        } 
    });
    jQuery('#datepicker2').datepicker({
         dateFormat: 'dd-M-yy',
         minDate: jQuery('#datepicker').val(),
         onSelect: function(dateText) {
            $sD = new Date(dateText);
            $("input#datepicker").datepicker('option', 'maxDate', dateText);
        } 

    });

    jQuery('#select-search-hide').select2({
        minimumResultsForSearch: -1
    });

    Dropzone.options.blurbPhoto = {
      init: function() {
            this.on("success", function(file) { 
        
                $('.blurb-photo').attr('src', $('.blurb-photo').attr('src') + '?' + new Date().getTime());
                window.location.reload();
            });

            this.on("error", function(file) { 
                alert('Invalid format');
                window.location.reload();
            });
        }
    };
</script>

@endsection