@extends('layouts.merchant')

@section('page-title', $restaurant->res_name . ' Campaign Details')

@section('custom-css')

<link href="{{asset('css/toggles.css')}}" rel="stylesheet">
<link href="{{asset('css/bootstrap-timepicker.min.css')}}" rel="stylesheet">
<link href="{{asset('css/style.datatables.css')}}" rel="stylesheet">
<link href="//cdn.datatables.net/responsive/2.1.0/css/responsive.dataTables.min.css" rel="stylesheet">
<link href="{{asset('css/morris.css')}}" rel="stylesheet">

@endsection

@section('body-contents')

<section>
	<div class="mainwrapper">

		@include('layouts.sidebar-merchant', ['restaurant' => $restaurant])

	    <div class="mainpanel">
            <div class="pageheader">
                <div class="media">
                    <div class="pageicon pull-left">
                        <i class="fa fa-tag"></i>
                    </div>
                    <div class="media-body">
                        <ul class="breadcrumb">
                            <li><a href=""><i class="glyphicon glyphicon-home"></i></a></li>
                            <li><a href="{{url('campaign')}}">Campaigns</a></li>
                            <li>Campaign Details</li>
                        </ul>
                        <h4>Campaign Details</h4>
                    </div>
                </div><!-- media -->
            </div><!-- pageheader -->
            
            <div class="contentpanel">
                <div class="panel panel-primary-head">
					
					<div class="col-sm-12 col-md-8 col-xs-12" style="padding-bottom:20px;">
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
						{!! Form::open(array('url' => 'campaign/'.$campaign->id, 'style' => 'display:inline;', 'class' => 'form-horizontal form-bordered')) !!}

							<div class="form-group">
								<label class="col-sm-2 control-label" style="text-align:left;">Campaign Name *</label>
								<div class="col-sm-8">
									<!-- <input type="text" value="" class="form-control" required /> -->
									{!! Form::text('campaign_name', $campaign->campaign_name, ['required' => 'required', 'class' => 'form-control']) !!}
								</div>
							</div><!-- form-group -->

							<div class="form-group">
								<label class="col-sm-2 control-label" style="text-align:left;">Timezone *</label>
								<div class="col-sm-8">
									<!-- <input type="text" value="GMT +08:00 (Singapore)" id="disabledinput" class="form-control" disabled="" /> -->
									{!! Form::text('cam_timezone', 'GMT +08:00 (Singapore)', ['readonly' => 'readonly', 'required' => 'required', 'class' => 'form-control']) !!}
								</div>
							</div><!-- form-group -->

							<div class="form-group">
								<label class="col-sm-2 control-label" style="text-align:left;">Start Date *</label>
								<div class="col-sm-8">
									<div class="input-group">
	                                    <!-- <input type="text" class="form-control" placeholder="DD-MMM-YYYY" id="datepicker" required> -->
	                                    {!! Form::text('cam_start', date_format(date_create($campaign['cam_end']), 'd-M-Y'), ['readonly' => 'readonly', 'required' => 'required', 'id' => 'datepicker', 'placeholder' => 'YYYY-MM-DD', 'class' => 'form-control']) !!}
	                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
	                                </div><!-- input-group -->
								</div>
							</div><!-- form-group -->

							<div class="form-group">
								<label class="col-sm-2 control-label" style="text-align:left;">End Date *</label>
								<div class="col-sm-8">
									<div class="input-group">
	                                    <!-- <input type="text" class="form-control" placeholder="DD-MMM-YYYY" id="datepicker2" required> -->
	                                    {!! Form::text('cam_end', date_format(date_create($campaign['cam_end']), 'd-M-Y'), ['readonly' => 'readonly', 'required' => 'required' ,'id' => 'datepicker2', 'placeholder' => 'YYYY-MM-DD', 'class' => 'form-control']) !!}
	                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
	                                </div><!-- input-group -->
								</div>
							</div><!-- form-group -->

							<br>

						{!! Form::close() !!}
					</div>
					<div class="col-sm-12 col-md-12 col-xs-12" style="padding-bottom:50px;">
						
						
						<a href="add-new-campaign.html">
							<button class="btn btn-primary" style="margin-left:15px;">Update Campaign</button>
						</a>
						<a href="">
							<button class="btn btn-success" style="margin-left:15px;">Submit Campaign</button>
						</a>
						<a href="">
							<button class="btn btn-danger" style="margin-left:15px;">Delete Campaign</button>
						</a>

						<a href="{{url('campaign')}}">
							<button style="margin-left:15px;" class="btn btn-default">Back</button>
						</a>
						<hr>
						<h4 class="md-title">Blurbs</h4>
						<br>
						<table id="basicTable" class="table table-striped table-bordered responsive">
							<thead class="">
								<tr>
									<th>Blurb Image</th>
									<th>Blurb Title</th>
									<th>Status</th>
									<th>Category</th>
									<th>Start Date</th>
									<th>End Date</th>
									<th></th>
								</tr>
							</thead>
					 
							<tbody>
								<tr>
									<td><img src="images/coupon-image.jpg" style="width:20px;"></td>
									<td><a href="view-blurb-pending.html">10% Off</a></td>
									<td><span class="text-warning"><strong>Pending Approval</strong></span></td>
									<td>Discount</td>
									<td>25-Jan-2016</td>
									<td>24-Mar-2016</td>
									<td class="table-action">
										<a href="view-blurb-pending.html" data-toggle="tooltip" title="View" class="tooltips"><i class="fa fa-eye"></i></a>
									</td>
								</tr>
								<tr>
									<td><img src="images/coupon-image.jpg" style="width:20px;"></td>
									<td><a href="view-blurb-pending.html">Free Latte with Purchase of at least $50</a></td>
									<td><span class="text-warning"><strong>Pending Approval</strong></span></td>
									<td>Freebies</td>
									<td>25-Jan-2016</td>
									<td>24-Mar-2016</td>
									<td class="table-action">
										<a href="view-blurb-pending.html" data-toggle="tooltip" title="View" class="tooltips"><i class="fa fa-eye"></i></a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
                </div><!-- panel -->
            </div><!-- contentpanel -->
        </div><!-- mainpanel -->
    </div><!-- mainwrapper -->
</section>


@endsection

@section('custom-js')

<script type="text/javascript" src="{{asset('js/jquery-ui-1.10.3.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/toggles.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap-timepicker.min.js')}}"></script>

<script type="text/javascript">

	// Date Picker
	jQuery('#datepicker').datepicker({ 
        dateFormat: 'yy-mm-dd',
        minDate: 0, // 0 days offset = today
        onSelect: function(dateText) {
            $sD = new Date(dateText);
            $("input#datepicker2").datepicker('option', 'minDate', dateText);
        } 
    });
	jQuery('#datepicker2').datepicker({
         dateFormat: 'yy-mm-dd',
         minDate: jQuery('#datepicker').val(),
         onSelect: function(dateText) {
            $sD = new Date(dateText);
            $("input#datepicker").datepicker('option', 'maxDate', dateText);
        } 

    });

</script>

@endsection
