@extends('layouts.admin')

@section('page-title', 'Add New Outlet')

@section('custom-css')

<link href="{{asset('css/toggles.css')}}" rel="stylesheet">
<link href="{{asset('css/bootstrap-timepicker.min.css')}}" rel="stylesheet">

@endsection

@section('body-contents')
    <section>
        <div class="mainwrapper">

             @include('layouts.sidebar-admin')

            <div class="mainpanel">
                <div class="pageheader">
                    <div class="media">
                        <div class="pageicon pull-left">
                            <i class="fa fa-plus-square"></i>
                        </div>
                        <div class="media-body">
                            <ul class="breadcrumb">
                                <li><a href="{{url('dashboard')}}"><i class="glyphicon glyphicon-home"></i></a></li>
                                <li><a href="{{url('merchants/'.$restaurant->merchant_id.'/edit')}}">Profile</a></li>
                                <li>Add New Outlet</li>
                            </ul>
                            <h4>Add New Outlet</h4>
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

                        <form method="POST" action="{{url('outlets')}}" class="form-horizontal form-bordered" >
						   <div class="form-group">
                                <label class="col-sm-2 control-label" style="text-align:left;">Outlet Name</label>
                                <div class="col-sm-8">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input type="hidden" name="merchant_id" value="{{$restaurant->merchant_id}}">
									<!-- <input type="text" value="Starbucks @ Northpoint" title="This is to differentiate from outlet's name." data-toggle="tooltip" data-trigger="hover" class="form-control tooltips" /> -->
									{!! Form::text('outlet_name', null, ['required' => 'required', 'data-trigger' => 'hover', 'data-toggle' => 'tooltip', 'title' => "This is to differentiate from outlet's name.", 'class' => 'form-control tooltips']) !!}
                                </div>
                            </div><!-- form-group -->

							<div class="form-group">
                                <label class="col-sm-2 control-label" style="text-align:left;">Outlet Address *</label>
                                <div class="col-sm-8">
                                    <!-- <textarea rows="5" placeholder="" class="form-control" />63 Chulia Street OCBC Centre East #01/01A01B</textarea> -->
                                    {!! Form::textarea('outlet_add', null, ['required' => 'required', 'class' => 'form-control', 'rows' => '5']) !!}
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
                                    {!! Form::number('outlet_zip', null, ['required' => 'required', 'class' => 'form-control']) !!}
                                </div>
                            </div><!-- form-group -->

							<div class="form-group">
                                <label class="col-sm-2 control-label" style="text-align:left;">Outlet's Phone Number *</label>
                                <div class="col-sm-8">
                                    <!-- <input type="text" value="+6564620097" class="form-control" /> -->
                                    {!! Form::text('outlet_phone', null, ['required' => 'required', 'class' => 'form-control']) !!}
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
                                <label class="col-xs-12 col-sm-2 control-label" style="text-align:left;"></label>
                                <div class="col-xs-1" style="width:50px;padding-top:12px;">
                                    <p>Mon</p>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2" style="max-width:80px;">
                                    <div class="toggle toggle-primary" data-toggle-on="true" id="mon-active-toggle"></div>
                                    <input name="outlet_mon_active" value="1" type="hidden" readonly="readonly" class="form-control mon-active-toggle" />
                                </div>
                                <div class="col-xs-3 col-sm-2">
                                	<div class="bootstrap-timepicker">
										<!-- <input id="timepicker-mon-start-1" type="text" class="form-control" value="21:00"/> -->
										{!! Form::text('outlet_mon_start', date('07:00'), ['id' => 'timepicker-mon-start-1', 'class' => 'toggle-timepicker-mon-active-toggle form-control']) !!}
									</div>
								</div>
								<div class="col-xs-1" style="width:40px;padding-top:12px;">
                                    <p style="text-align:center;">to</p>
                                </div>
								<div class="col-xs-3 col-sm-2">
									<div class="bootstrap-timepicker">
										<!-- <input id="timepicker-mon-end-1" type="text" class="form-control" value="21:00"/> -->
										<div class="bootstrap-timepicker">{!! Form::text('outlet_mon_end', date('21:00', time()+28800), ['id' => 'timepicker-mon-end-1', 'class' => 'toggle-timepicker-mon-active-toggle form-control']) !!}</div>
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
                                    <input name="outlet_tue_active" value="1" type="hidden" readonly="readonly" class="form-control tue-active-toggle" />
                                </div>
                                <div class="col-xs-3 col-sm-2">
									<!-- <div class="bootstrap-timepicker"><input id="timepicker-tue-start-1" type="text" class="form-control" value="07:00"/></div> -->
                                    <div class="bootstrap-timepicker">{!! Form::text('outlet_tue_start', date('07:00'), ['id' => 'timepicker-tue-start-1', 'class' => 'toggle-timepicker-tue-active-toggle form-control']) !!}</div>
								</div>
								<div class="col-xs-1" style="width:40px;padding-top:12px;">
                                    <p style="text-align:center;">to</p>
                                </div>
								<div class="col-xs-3 col-sm-2">
									<div class="bootstrap-timepicker">{!! Form::text('outlet_tue_end', date('21:00', time()+28800), ['id' => 'timepicker-tue-end-1', 'class' => 'toggle-timepicker-tue-active-toggle form-control']) !!}</div>
								</div>
                            </div><!-- form-group -->

							<div class="form-group openinghours-form">
                                <label class="col-xs-12 col-sm-2 control-label" style="text-align:left;"></label>

                                <div class="col-xs-1" style="width:50px;padding-top:12px;">
                                    <p>Wed</p>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2" style="max-width:80px;">
                                    <div class="toggle toggle-primary" id="wed-active-toggle"></div>
                                    <input name="outlet_wed_active" value="1" type="hidden" readonly="readonly" class="form-control wed-active-toggle" />
                                </div>
                                <div class="col-xs-3 col-sm-2">
									<div class="bootstrap-timepicker">{!! Form::text('outlet_wed_start', date('07:00'), ['id' => 'timepicker-wed-start-1', 'class' => 'toggle-timepicker-wed-active-toggle form-control']) !!}</div>
								</div>
								<div class="col-xs-1" style="width:40px;padding-top:12px;">
                                    <p style="text-align:center;">to</p>
                                </div>
								<div class="col-xs-3 col-sm-2">
									<div class="bootstrap-timepicker">{!! Form::text('outlet_wed_end', date('21:00', time()+28800), ['id' => 'timepicker-wed-end-1', 'class' => 'toggle-timepicker-wed-active-toggle form-control']) !!}</div>
								</div>
                            </div><!-- form-group -->

							<div class="form-group openinghours-form">
                                <label class="col-xs-12 col-sm-2 control-label" style="text-align:left;"></label>

                                <div class="col-xs-1" style="width:50px;padding-top:12px;">
                                    <p>Thu</p>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2" style="max-width:80px;">
                                    <div class="toggle toggle-primary" id="thu-active-toggle"></div>
                                    <input name="outlet_thu_active" value="1" type="hidden" readonly="readonly" class="form-control thu-active-toggle" />
                                </div>
                                <div class="col-xs-3 col-sm-2">
									<div class="bootstrap-timepicker">{!! Form::text('outlet_thu_start', date('07:00'), ['id' => 'timepicker-thu-start-1', 'class' => 'toggle-timepicker form-control']) !!}</div>
								</div>
								<div class="col-xs-1" style="width:40px;padding-top:12px;">
                                    <p style="text-align:center;">to</p>
                                </div>
								<div class="col-xs-3 col-sm-2">
									<div class="bootstrap-timepicker">{!! Form::text('outlet_thu_end', date('21:00', time()+28800), ['id' => 'timepicker-thu-end-1', 'class' => 'toggle-timepicker form-control']) !!}</div>
								</div>
                            </div><!-- form-group -->

							<div class="form-group openinghours-form">
                                <label class="col-xs-12 col-sm-2 control-label" style="text-align:left;"></label>

                                <div class="col-xs-1" style="width:50px;padding-top:12px;">
                                    <p>Fri</p>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2" style="max-width:80px;">
                                    <div class="toggle toggle-primary" id="fri-active-toggle"></div>
                                    <input name="outlet_fri_active" value="1" type="hidden" readonly="readonly" class="form-control fri-active-toggle" />
                                </div>
                                <div class="col-xs-3 col-sm-2">
									<div class="bootstrap-timepicker">{!! Form::text('outlet_fri_start', date('07:00'), ['id' => 'timepicker-fri-start-1', 'class' => 'toggle-timepicker-fri-active-toggle form-control']) !!}</div>
								</div>
								<div class="col-xs-1" style="width:40px;padding-top:12px;">
                                    <p style="text-align:center;">to</p>
                                </div>
								<div class="col-xs-3 col-sm-2">
									<div class="bootstrap-timepicker">{!! Form::text('outlet_fri_end', date('21:00', time()+28800), ['id' => 'timepicker-fri-end-1', 'class' => 'toggle-timepicker-fri-active-toggle form-control']) !!}</div>
								</div>
                            </div><!-- form-group -->

							<div class="form-group openinghours-form">
                                <label class="col-xs-12 col-sm-2 control-label" style="text-align:left;"></label>

                                <div class="col-xs-1" style="width:50px;padding-top:12px;">
                                    <p>Sat</p>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2" style="max-width:80px;">
                                    <div class="toggle toggle-primary" id="sat-active-toggle"></div>
                                    <input name="outlet_sat_active" value="1" type="hidden" readonly="readonly" class="form-control sat-active-toggle" />
                                </div>
                                <div class="col-xs-3 col-sm-2">
									<div class="bootstrap-timepicker">{!! Form::text('outlet_sat_start', date('07:00'), ['id' => 'timepicker-sat-start-1', 'class' => 'toggle-timepicker form-control']) !!}</div>
								</div>
								<div class="col-xs-1" style="width:40px;padding-top:12px;">
                                    <p style="text-align:center;">to</p>
                                </div>
								<div class="col-xs-3 col-sm-2">
									<div class="bootstrap-timepicker">{!! Form::text('outlet_sat_end', date('21:00', time()+28800), ['id' => 'timepicker-sat-end-1', 'class' => 'toggle-timepicker form-control']) !!}</div>
								</div>
                            </div><!-- form-group -->

							<div class="form-group openinghours-form">
                                <label class="col-xs-12 col-sm-2 control-label" style="text-align:left;"></label>

                                <div class="col-xs-1" style="width:50px;padding-top:12px;">
                                    <p>Sun</p>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2" style="max-width:80px;">
                                    <div class="toggle toggle-primary" id="sun-active-toggle"></div>
                                    <input name="outlet_sun_active" value="1" type="hidden" readonly="readonly" class="form-control sun-active-toggle" />
                                </div>
                                <div class="col-xs-3 col-sm-2">
									<div class="bootstrap-timepicker">{!! Form::text('outlet_sun_start', date('07:00'), ['id' => 'timepicker-sun-start-1', 'class' => 'toggle-timepicker form-control']) !!}</div>
								</div>
								<div class="col-xs-1" style="width:40px;padding-top:12px;">
                                    <p style="text-align:center;">to</p>
                                </div>
								<div class="col-xs-3 col-sm-2">
									<div class="bootstrap-timepicker">{!! Form::text('outlet_sun_end', date('21:00', time()+28800), ['id' => 'timepicker-sun-end-1', 'class' => 'toggle-timepicker form-control']) !!}</div>
								</div>
                            </div><!-- form-group -->

							<div class="form-group openinghours-form">
                                <label class="col-xs-12 col-sm-2 control-label" style="text-align:left;"></label>

                                <div class="col-xs-1" style="width:50px;padding-top:12px;">
                                    <p>PH</p>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2" style="max-width:80px;">
                                    <div class="toggle toggle-primary" id="ph-active-toggle"></div>
                                    <input name="outlet_ph_active" value="1" type="hidden" readonly="readonly" class="form-control ph-active-toggle" />
                                </div>
                                <div class="col-xs-3 col-sm-2">
                                    <div class="bootstrap-timepicker">{!! Form::text('outlet_ph_start', date('07:00'), ['id' => 'timepicker-ph-start-1', 'class' => 'toggle-timepicker form-control']) !!}</div>
                                </div>
                                <div class="col-xs-1" style="width:40px;padding-top:12px;">
                                    <p style="text-align:center;">to</p>
                                </div>
                                <div class="col-xs-3 col-sm-2">
                                    <div class="bootstrap-timepicker">{!! Form::text('outlet_ph_end', date('21:00', time()+28800), ['id' => 'timepicker-ph-end-1', 'class' => 'toggle-timepicker form-control']) !!}</div>
                                </div>
                            </div><!-- form-group -->

                            <button type="submit" class="btn btn-primary">Add</button>
                            <a href="{{url('merchants/'.$restaurant->merchant_id.'/edit')}}"><button type="button" style="margin-left:15px;" class="btn btn-default">Cancel</button></a>
                        </form>

					</div>
                </div><!-- contentpanel -->

            </div>
        </div><!-- mainwrapper -->
    </section>

@endsection

@section('custom-js')

<script type="text/javascript">
    
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
<script type="text/javascript">$('.toggle').toggles({on: true});</script>
@endsection
