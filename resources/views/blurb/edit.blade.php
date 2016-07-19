@extends('layouts.admin')

@section('page-title', $restaurant->res_name . ' Campaign Details')

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
                            <li>View Blurb</li>
                        </ul>
                        <h4>View Blurb</h4>
                    </div>
                </div><!-- media -->
            </div><!-- pageheader -->

            <div class="contentpanel">

                <div class="row">
                    <div class="col-sm-12 col-md-4 col-xs-12" style="padding-bottom:30px;max-width:417px;min-width:300px;">
						<div style="border: 1px solid #ccc;">
							@if(!is_null($blurb->blurb_logo))
                            <img src="{{asset($blurb['blurb_logo'])}}" style="width:100%">
                            @else
                            <img src="{{asset('images/no-coupon.png')}}" style="width:100%">
                            @endif

                            @if(!is_null($restaurant->res_logo))
                            <img class="img-roundedcircle img-offline img-responsive img-profile" src="{{( is_null($restaurant->res_logo)) ? env('MERCHANT_URL').'/images/nopp.jpg' : env('MERCHANT_URL').'/uploads/'.$restaurant->merchant_id.'/profile_picture.jpg'}}" style="max-width:50px;margin:20px 10px 20px 20px;" alt="">
                            <span style="font-size:16px;">{{$restaurant->res_name}}</span>
                            @else
                            <div style="max-width:50px;margin:20px 10px 20px 20px;" class="img-roundedcircle square img-offline img-responsive img-profile">
                                <p>@if(!is_null($restaurant->res_name)) {{strtoupper($restaurant->res_name[0])}} @endif</p>
                            </div>
                            @endif
							<div class="mb10"></div>
							<span style="margin:20px;font-size:15px;font-weight:bold;">{{$restaurant->res_name}}</span>
							<div style="margin:20px;">{{$restaurant->res_desc}}</div>
							<div class="mb20"></div>
							<table style="width:100%;margin: 30px 0;">
								<tbody>
									<tr style="border-top:1px solid #ccc;border-bottom:1px solid #ccc;">
										<td style="width:60%;padding:20px;font-weight:bold;">VALID TILL</td>
										<td style="width:40%;text-align:right;padding:20px;">30 APR 2016</td>
									</tr>
								</tbody>
							</table>
							<div style="margin:20px;text-align:center;"><u>TERMS & CONDITIONS</u></div>
							<div style="margin:20px;text-align:justify;">{{$restaurant->res_terms}}</div>
							<div class="mb20"></div>
						</div>
                    </div><!-- col-sm-4 col-md-3 -->

                    <div class="col-sm-12 col-md-8 col-xs-12">
                        <div class="tab-content nopadding noborder">
								<div class="col-sm-12" style="padding-bottom:30px;">
									<div class="col-sm-10">
										<label style="padding-bottom: 10px;">Blurb Image *</label>
										<form action="files" class="dropzone">
											<div class="fallback">
												<input name="file" type="file" id="disabledinput" disabled="" />
											</div>
										</form>
										<span class="help-block">Must be a square size with at least 500px x 500px.</span>
									</div>
								</div>
								<form class="form-horizontal form-bordered">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" style="text-align:left;">Blurb Title *</label>
                                        <div class="col-sm-8">
                                            <input type="text" value="$5 Big MAC & 16oz COKE" class="form-control" required id="disabledinput" disabled="" />
                                        </div>
                                    </div><!-- form-group -->

									<div class="form-group">
                                        <label class="col-sm-2 control-label" style="text-align:left;">Category *</label>
                                        <div class="col-sm-8">
                                            <select id="select-search-hide" data-placeholder="Choose One" class="width300" required id="disabledinput" disabled="" />
												<option value="">Choose One</option>
												<option value="Discount" selected>Discount</option>
												<option value="Freebies">Freebies</option>
											</select>
                                        </div>
                                    </div><!-- form-group -->

									<div class="form-group">
										<label class="col-sm-2 control-label" style="text-align:left;">Start Date *</label>
										<div class="col-sm-8">
											<div class="input-group">
												<input type="text" class="form-control" value="01-Apr-2016" placeholder="DD-MMM-YYYY" id="datepicker" required id="disabledinput" disabled="" />
												<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
											</div><!-- input-group -->
										</div>
									</div><!-- form-group -->

									<div class="form-group">
										<label class="col-sm-2 control-label" style="text-align:left;">End Date *</label>
										<div class="col-sm-8">
											<div class="input-group">
												<input type="text" class="form-control" value="30-Apr-2016" placeholder="DD-MMM-YYYY" id="datepicker2" required id="disabledinput" disabled="" />
												<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
											</div><!-- input-group -->
										</div>
									</div><!-- form-group -->

									<div class="form-group">
                                        <label class="col-sm-2 control-label" style="text-align:left;">Description *</label>
                                        <div class="col-sm-8">
                                            <textarea rows="5" class="form-control" maxlength="500" required id="disabledinput" disabled="" />Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</textarea>
                                        </div>
                                    </div><!-- form-group -->

									<div class="form-group">
                                        <label class="col-sm-2 control-label" style="text-align:left;">Terms & Conditions *</label>
                                        <div class="col-sm-8">
                                            <textarea rows="5" class="form-control" maxlength="2000" id="disabledinput" disabled="" />Valid in Singapore from 1st Jan till 31st Jan 2013. Blurb cannot be used with any other offers and is valid for one redemption per transaction. Offer only valid from 12nn to 3pm. Applicable for featured offer only, while stocks last. Restaurants' operating hours may vary. Not applicable for McDelivery, iFly Singapore and institutional stores. Customers must present original coupons for redemption.</textarea>
                                        </div>
                                    </div><!-- form-group -->

									<div class="form-group">
                                        <label class="col-sm-2 control-label" style="text-align:left;">Status</label>
                                        <div class="col-sm-8">
                                            <label class="control-label text-success" style="text-align:left;font-weight:bold;">Approved</label>
                                        </div>
                                    </div><!-- form-group -->

									<br>
                                    <button style="margin-left:15px;" class="btn btn-default">Back</button>
                                </form>
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
</script>

@endsection
