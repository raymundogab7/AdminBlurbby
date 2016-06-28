<div class="col-sm-12 col-md-8 col-xs-12" style="padding-bottom:20px;">
	<form class="form-horizontal form-bordered" style="display:inline;">
		<div class="form-group">
			<label class="col-sm-2 control-label" style="text-align:left;">Campaign Name *</label>
			<div class="col-sm-8">
				<input type="text" value="{{$campaign->campaign_name}}" class="form-control" id="disabledinput" disabled="" />
			</div>
		</div><!-- form-group -->
		
		<div class="form-group">
			<label class="col-sm-2 control-label" style="text-align:left;">Timezone *</label>
			<div class="col-sm-8">
				<input type="text" value="GMT +08:00 (Singapore)" id="disabledinput" class="form-control" disabled="" />
			</div>
		</div><!-- form-group -->
		
		<div class="form-group">
			<label class="col-sm-2 control-label" style="text-align:left;">Start Date *</label>
			<div class="col-sm-8">
				<div class="input-group">
					<input type="text" class="form-control" value="{{date_format(date_create($campaign['cam_start']), 'd-M-Y')}}"" placeholder="DD-MMM-YYYY" id="disabledinput" disabled="">
					<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
				</div><!-- input-group -->
			</div>
		</div><!-- form-group -->
		
		<div class="form-group">
			<label class="col-sm-2 control-label" style="text-align:left;">End Date *</label>
			<div class="col-sm-8">
				<div class="input-group">
					<input type="text" class="form-control" value="{{date_format(date_create($campaign['cam_end']), 'd-M-Y')}}" placeholder="DD-MMM-YYYY" id="disabledinput" disabled="">
					<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
				</div><!-- input-group -->
			</div>
		</div><!-- form-group -->
		
		<div class="form-group">
			<label class="col-sm-2 control-label" style="text-align:left;">Status</label>
			<div class="col-sm-8">
				<label class="text-nuted control-label" style="text-align:left;"><strong>{{$campaign->cam_status}}</strong></label>
			</div>
		</div><!-- form-group -->
	</form>
	<hr style="margin-top:0;">
	<a href="{{url('blurb/view/'.$campaign->control_no.'/expired')}}">	
		<button class="btn btn-primary">View Blurbs</button>
	</a>
	{!! Form::open(array('url' => 'campaign/duplicate/'.$campaign->id, 'style' => 'display:inline;', 'class' => 'form-horizontal form-bordered', 'method' => 'POST')) !!}
	<button class="btn btn-warning">Duplicate Campaign</button>
	{!! Form::close() !!}
	<a href="{{url('campaign')}}">
		<button style="margin-left:15px;" class="btn btn-default">Back</button>
	</a>

	<hr>

	{!! Form::open(array('url' => 'campaign/report/generate/'.$campaign->id, 'style' => 'display:inline;', 'class' => 'form-horizontal form-bordered')) !!}
		<input type="hidden" name="cam_status" value="Expired" readonly="">
		<button class="btn btn-info" style="margin-left:15px;"><i class="fa fa-file-excel-o"></i>&nbsp;
			Download Analytics Report (.csv)
		</button>
	{!! Form::close() !!}
	<input type="hidden" disabled="" id="campaign_id" value="{{$campaign->id}}">
</div>

<div class="col-sm-12 col-md-12 col-xs-12" style="padding-bottom:20px;">
	
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-body padding15">
				<h5 class="md-title mt0 mb10">Campaign's Total Likes</h5>
				<div id="basicflot" class="flotChart"></div>
			</div><!-- panel-body -->
		</div><!-- panel -->
	</div>
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-body padding15">
				<h5 class="md-title mt0 mb10">Campaign's Total Views</h5>
				<div id="basicflot2" class="flotChart"></div>
			</div><!-- panel-body -->
		</div><!-- panel -->
	</div>
	
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-body padding15">
				<h5 class="md-title mt0 mb10">Campaign's Total Usage</h5>
				<div id="basicflot3" class="flotChart"></div>
			</div><!-- panel-body -->
		</div><!-- panel -->
	</div>
</div>

@section('custom-js')

<script type="text/javascript" src="{{asset('js/flot/jquery.flot.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/flot/jquery.flot.resize.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/flot/jquery.flot.spline.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/raphael-2.1.0.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap-wizard.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/campaign_charts.js')}}"></script>

@endsection