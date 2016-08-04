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
					<input type="text" class="form-control" value="{{date_format(date_create($campaign['cam_start']), 'M-d-Y')}}"" placeholder="DD-MMM-YYYY" id="disabledinput" disabled="">
					<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
				</div><!-- input-group -->
			</div>
		</div><!-- form-group -->

		<div class="form-group">
			<label class="col-sm-2 control-label" style="text-align:left;">End Date *</label>
			<div class="col-sm-8">
				<div class="input-group">
					<input type="text" class="form-control" value="{{date_format(date_create($campaign['cam_end']), 'M-d-Y')}}" placeholder="DD-MMM-YYYY" id="disabledinput" disabled="">
					<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
				</div><!-- input-group -->
			</div>
		</div><!-- form-group -->

		<div class="form-group">
            <label class="col-sm-2 control-label" style="text-align:left;">Status *</label>
            <div class="col-sm-8">
                <select id="select_status" name="cam_status" data-placeholder="Choose One" style="width:100%;" tabindex="-1" title="" class="select2-offscreen">
					<option value="Draft" <?php if ($campaign->cam_status == "Draft"): ?> selected="selected" <?php endif;?> > >Draft</option>
					<option value="Pending Approval" <?php if ($campaign->cam_status == "Pending Approval"): ?> selected="selected" <?php endif;?>>Pending Approval</option>
					<option value="Approved" <?php if ($campaign->cam_status == "Approved"): ?> selected="selected" <?php endif;?>>Approved</option>
					<option value="Rejected" <?php if ($campaign->cam_status == "Rejected"): ?> selected="selected" <?php endif;?>>Rejected</option>
                </select>
            </div>
        </div>
	</form>
</div>
<div class="col-sm-12 col-md-12 col-xs-12" style="padding-bottom:50px;">
	<hr style="margin-top:0;">
     <a href="{{url('blurb/view/'.$campaign->control_no.'/approved')}}">
		<button class="btn btn-primary">View Blurbs</button>
	</a>
	{!! Form::open(array('url' => 'campaigns/duplicate/'.$campaign->id, 'style' => 'display:inline;', 'class' => 'form-horizontal form-bordered', 'method' => 'POST')) !!}
	<button class="btn btn-warning">Duplicate Campaign</button>
	{!! Form::close() !!}
	<a href="{{url('merchants/'.$campaign->merchant_id.'/edit')}}">
		<button style="margin-left:15px;" class="btn btn-default">Back</button>
	</a>
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
<script type="text/javascript" src="{{asset('js/charts.js')}}"></script>

@endsection