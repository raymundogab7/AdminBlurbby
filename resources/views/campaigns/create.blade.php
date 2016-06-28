@extends('layouts.merchant')

@section('page-title', $restaurant->res_name . ' Add New Campaign')

@section('custom-css')

<link href="{{asset('css/toggles.css')}}" rel="stylesheet">
<link href="{{asset('css/bootstrap-timepicker.min.css')}}" rel="stylesheet">

@endsection

@section('body-contents')

<section>
    <div class="mainwrapper">
    
        @include('layouts.sidebar-merchant', ['restaurant' => $restaurant])

        <div class="mainpanel">
            <div class="pageheader">
                <div class="media">
                    <div class="pageicon pull-left">
                        <i class="fa fa-plus-square"></i>
                    </div>
                    <div class="media-body">
                        <ul class="breadcrumb">
                            <li><a href="index.html"><i class="glyphicon glyphicon-home"></i></a></li>
                            <li>Add New Campaign</li>
                        </ul>
                        <h4>Add New Campaign</h4>
                    </div>
                </div><!-- media -->
            </div><!-- pageheader -->

            <div class="contentpanel">
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
					{!! Form::open(array('url' => 'campaign', 'style' => 'display:inline;', 'class' => 'form-horizontal form-bordered')) !!}

						<div class="form-group">
							<label class="col-sm-2 control-label" style="text-align:left;">Campaign Name *</label>
							<div class="col-sm-8">
								<!-- <input type="text" value="" class="form-control" required /> -->
								{!! Form::text('campaign_name', null, ['required' => 'required', 'class' => 'form-control']) !!}
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
                                    {!! Form::text('cam_start', null, ['readonly' => 'readonly', 'required' => 'required', 'id' => 'datepicker', 'placeholder' => 'YYYY-MM-DD', 'class' => 'form-control']) !!}
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                </div><!-- input-group -->
							</div>
						</div><!-- form-group -->

						<div class="form-group">
							<label class="col-sm-2 control-label" style="text-align:left;">End Date *</label>
							<div class="col-sm-8">
								<div class="input-group">
                                    <!-- <input type="text" class="form-control" placeholder="DD-MMM-YYYY" id="datepicker2" required> -->
                                    {!! Form::text('cam_end', null, ['readonly' => 'readonly', 'required' => 'required' ,'id' => 'datepicker2', 'placeholder' => 'YYYY-MM-DD', 'class' => 'form-control']) !!}
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                </div><!-- input-group -->
							</div>
						</div><!-- form-group -->

						<br>

						<button style="margin-left:15px;" class="btn btn-primary">Create and Add New Blurbs</button>

					{!! Form::close() !!}

					<a href="{{url('campaign')}}"><button style="margin-left:15px;" class="btn btn-default">Cancel</button></a>
				</div>
            </div><!-- contentpanel -->

        </div>
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
