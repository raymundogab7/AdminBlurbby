
<div class="col-sm-12 col-md-8 col-xs-12" style="padding-bottom:20px;">

	<form method="POST" action="{{url('campaigns/'.$campaign['id'])}}" style="display:inline;" class="form-horizontal form-bordered" >
	<div class="form-group">
		<label class="col-sm-2 control-label" style="text-align:left;">Campaign Name *</label>
		<div class="col-sm-8">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
			<!-- <input type="text" value="" class="form-control" required /> -->
			{!! Form::text('campaign_name', $campaign['campaign_name'], ['required' => 'required', 'class' => 'form-control']) !!}
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
                {!! Form::text('cam_start', date_format(date_create($campaign['cam_start']), 'Y-m-d'), ['required' => 'required', 'id' => 'datepicker', 'placeholder' => 'YYYY-MM-DD', 'class' => 'form-control']) !!}
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
            </div><!-- input-group -->
		</div>
	</div><!-- form-group -->

	<div class="form-group">
		<label class="col-sm-2 control-label" style="text-align:left;">End Date *</label>
		<div class="col-sm-8">
			<div class="input-group">
                <!-- <input type="text" class="form-control" placeholder="DD-MMM-YYYY" id="datepicker2" required> -->
                {!! Form::text('cam_end', date_format(date_create($campaign['cam_end']), 'Y-m-d'), ['required' => 'required' ,'id' => 'datepicker2', 'placeholder' => 'YYYY-MM-DD', 'class' => 'form-control']) !!}
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
            </div><!-- input-group -->
		</div>
	</div><!-- form-group -->

	<div class="form-group">
        <label class="col-sm-2 control-label" style="text-align:left;">Status</label>
        <div class="col-sm-8">
            <label class="text-info control-label" style="text-align:left;"><strong>{{$campaign['cam_status']}}</strong></label>
        </div>
    </div><!-- form-group -->
	<button class="btn btn-primary" style="margin-left:15px;">Update Campaign</button>

	</form>

	{!! Form::open(array('url' => 'campaigns/updateStatus/'.$campaign['id'], 'style' => 'display:inline;', 'class' => 'form-horizontal form-bordered', 'method' => 'PUT')) !!}

	<input type="hidden" name="cam_status" value="Pending Approval">
	<a href="">
		<button class="btn btn-success" style="margin-left:15px;">Submit Campaign</button>
	</a>

	{!! Form::close() !!}

	{!! Form::open(array('url' => 'campaigns/'.$campaign['id'], 'style' => 'display:inline;', 'class' => 'form-horizontal form-bordered', 'method' => 'DELETE')) !!}

	<a href="">
		<button class="btn btn-danger" style="margin-left:15px;">Delete Campaign</button>
	</a>

	{!! Form::close() !!}
	<a href="{{url('merchants/'.$campaign->merchant_id.'/edit')}}">
		<button style="margin-left:15px;" class="btn btn-default">Back</button>
	</a>
</div>

<div class="col-sm-12 col-md-12 col-xs-12" style="padding-bottom:50px;">
    <hr>
    <h4 class="md-title">Blurbs</h4>
    <br>
	<a href="{{url('blurb/create/'.$campaign['control_no'])}}"><button class="btn btn-primary"><i class="fa fa-plus"></i> Add New Blurb</button></a>
    <table id="draftBlurbTable" class="table table-striped table-bordered responsive">
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
            @foreach($blurbs as $blurb)
            <tr>
            	 @if(!is_null($blurb['blurb_logo']))
                @if($blurb['photo_location'] == 'merchant')
                <td><img src="{{env('MERCHANT_URL').'/'.$blurb['blurb_logo']}}" style="width:20px"></td>
                @else
                <td><img src="{{asset($blurb['blurb_logo'])}}" style="width:20px"></td>
                @endif
                @else
                <td><!-- <img src="{{asset('images/no-blurb.png')}}" style="width:20px">  -->No Image Available</td>
                @endif

                <td><a href="{{url('blurb/'.$blurb['id'].'/'.$campaign['control_no'])}}">{{$blurb['blurb_name']}}</a></td>
                <td>
                	@if($blurb['blurb_status'] == 'Approved')
                	<span class="text-success">
                	@elseif($blurb['blurb_status'] == 'Created')
                	<span class="text-info">
                	@elseif($blurb['blurb_status'] == 'Live')
                	<span class="text-success">
                    @elseif($blurb['blurb_status'] == 'Expired')
                    <span class="text-muted">
                    @elseif($blurb['blurb_status'] == 'Rejected')
                    <span class="text-danger">
                	@else
                	<span class="text-warning">
                	@endif
	                <strong>{{$blurb['blurb_status']}}</strong>
	                </span>
                </td>
                <td>{{$blurb['category']['blurb_cat_name']}}</td>
                <td>{{date_format(date_create($blurb['blurb_start']), 'd-M-Y')}}</td>
                <td>{{date_format(date_create($blurb['blurb_end']), 'd-M-Y')}}</td>
                <td class="table-action">
                @if($blurb['blurb_status'] == 'Rejected' || $blurb['blurb_status'] == 'Created')

                    <a href="{{url('blurb/'.$blurb['id'].'/'.$campaign['control_no'])}}" data-toggle="tooltip" title="Edit" class="tooltips"><i class="fa fa-pencil"></i></a>
                    <a href="#deleteBlurbModal" data-blurb-id="{{$blurb['id']}}" data-blurb-name="{{$blurb['blurb_name']}}" data-target="#deleteBlurbModal" data-toggle="modal" title="Delete" class="tooltips"><i class="fa fa-trash-o"></i></a>
                @else

                    <a href="{{url('blurb/'.$blurb['id'].'/'.$campaign->control_no)}}" data-toggle="tooltip" title="View" class="tooltips"><i class="fa fa-eye"></i></a>
                @endif


                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="modal fade deleteBlurbModal" id="deleteBlurbModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete Blurb</h4>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this blurb?
      </div>
      <div class="modal-footer">

        {!! Form::open(array('url' => '', 'class' => 'form-horizontal form-bordered delete-blurb-form')) !!}

        <input name="_method" type="hidden" value="DELETE">
        <input type="hidden" id="blurbId" name="blurb_id">
        <input type="hidden" class="controlNo" value="{{$campaign['id']}}">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        <button class="btn btn-primary delete-blurb-yes">Yes</button>

        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>

@section('custom-js')
<script type="text/javascript">
    $('.deleteBlurbModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var blurb_id = button.data('blurb-id');
        console.log(blurb_id);
        var blurb_name = button.data('blurb-name');
        var modal = $(this);
        modal.find('.modal-title').text('Delete ' + blurb_name);
        modal.find('.modal-footer #blurbId').val(blurb_id);
        $('.delete-blurb-form').attr('action', '/blurb/'+blurb_id+'/'+$('.controlNo').val());
    });

    jQuery(document).ready(function(){

        jQuery('#draftBlurbTable').DataTable({
            responsive: true,
            order:[]
        });

        var shTable = jQuery('#shTable').DataTable({
            "fnDrawCallback": function(oSettings) {
                jQuery('#shTable_paginate ul').addClass('pagination-active-dark');
            },
            responsive: true
        });
    });

</script>

<script type="text/javascript" src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="//cdn.datatables.net/plug-ins/725b2a2115b/integration/bootstrap/3/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js"></script>
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
