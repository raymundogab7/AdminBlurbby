@extends('layouts.admin')

@section('page-title', 'Edit Outlet Details')

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
                                <li><a href="{{url('merchant-profile')}}">Profile</a></li>
                                <li>Edit Outlet Details</li>
                            </ul>
                            <h4>Edit Outlet Details</h4>
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

                        <form method="POST" action="{{url('outlets/'.$outlet->id)}}" class="form-horizontal form-bordered" >
                            <input type="hidden" name="outlet_id" value="{{$outlet->id}}">
                           <div class="form-group">
                                <label class="col-sm-2 control-label" style="text-align:left;">Main Outlet Name</label>
                                <div class="col-sm-8">
                                    <input type="hidden" name="_method" value="PUT">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <!-- <input type="text" value="Starbucks @ Northpoint" title="This is to differentiate from outlet's name." data-toggle="tooltip" data-trigger="hover" class="form-control tooltips" /> -->
                                    {!! Form::text('outlet_name', $outlet->outlet_name, ['required' => 'required', 'data-trigger' => 'hover', 'data-toggle' => 'tooltip', 'title' => "This is to differentiate from outlet's name.", 'class' => 'form-control tooltips']) !!}
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
                                    {!! Form::text('outlet_country', $outlet->outlet_country, ['id' => 'disabledinput', 'readonly' => 'readonly', 'class' => 'form-control']) !!}
                                </div>
                            </div><!-- form-group -->

                            <div class="form-group">
                                <label class="col-sm-2 control-label" style="text-align:left;">Outlet's Postal Code *</label>
                                <div class="col-sm-8">
                                    <!-- <input type="text" value="049514" class="form-control" /> -->
                                    {!! Form::number('outlet_zip', $outlet->outlet_zip, ['class' => 'form-control', 'maxlength' => '6']) !!}
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
                                    {!! Form::text('outlet_timezone', $outlet->outlet_timezone, ['id' => 'disabledinput', 'readonly' => 'readonly', 'class' => 'form-control']) !!}
                                </div>
                            </div><!-- form-group -->

                            <div class="form-group openinghours-form">
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
                                        {!! Form::text('outlet_mon_start', $outlet->outlet_mon_start, ['id' => 'timepicker-mon-start-1', 'class' => 'toggle-timepicker-mon-active-toggle form-control time-sched']) !!}
                                    </div>
                                </div>
                                <div class="col-xs-1" style="width:40px;padding-top:12px;">
                                    <p style="text-align:center;">to</p>
                                </div>
                                <div class="col-xs-3 col-sm-2">
                                    <div class="bootstrap-timepicker">
                                        <!-- <input id="timepicker-mon-end-1" type="text" class="form-control" value="21:00"/> -->
                                        <div class="bootstrap-timepicker">{!! Form::text('outlet_mon_end', $outlet->outlet_mon_end, ['id' => 'timepicker-mon-end-1', 'class' => 'toggle-timepicker-mon-active-toggle form-control time-sched']) !!}</div>
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
                                    <div class="bootstrap-timepicker">{!! Form::text('outlet_tue_start', $outlet->outlet_tue_start, ['id' => 'timepicker-tue-start-1', 'class' => 'toggle-timepicker-tue-active-toggle form-control time-sched']) !!}</div>
                                </div>
                                <div class="col-xs-1" style="width:40px;padding-top:12px;">
                                    <p style="text-align:center;">to</p>
                                </div>
                                <div class="col-xs-3 col-sm-2">
                                    <div class="bootstrap-timepicker">{!! Form::text('outlet_tue_end', $outlet->outlet_tue_end, ['id' => 'timepicker-tue-end-1', 'class' => 'toggle-timepicker-tue-active-toggle form-control time-sched']) !!}</div>
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
                                    <div class="bootstrap-timepicker">{!! Form::text('outlet_wed_start', $outlet->outlet_wed_start, ['id' => 'timepicker-wed-start-1', 'class' => 'toggle-timepicker-wed-active-toggle form-control time-sched']) !!}</div>
                                </div>
                                <div class="col-xs-1" style="width:40px;padding-top:12px;">
                                    <p style="text-align:center;">to</p>
                                </div>
                                <div class="col-xs-3 col-sm-2">
                                    <div class="bootstrap-timepicker">{!! Form::text('outlet_wed_end', $outlet->outlet_wed_end, ['id' => 'timepicker-wed-end-1', 'class' => 'toggle-timepicker-wed-active-toggle form-control time-sched']) !!}</div>
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
                                    <div class="bootstrap-timepicker">{!! Form::text('outlet_thu_start', $outlet->outlet_thu_start, ['id' => 'timepicker-thu-start-1', 'class' => 'toggle-timepicker form-control time-sched']) !!}</div>
                                </div>
                                <div class="col-xs-1" style="width:40px;padding-top:12px;">
                                    <p style="text-align:center;">to</p>
                                </div>
                                <div class="col-xs-3 col-sm-2">
                                    <div class="bootstrap-timepicker">{!! Form::text('outlet_thu_end', $outlet->outlet_thu_end, ['id' => 'timepicker-thu-end-1', 'class' => 'toggle-timepicker form-control time-sched']) !!}</div>
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
                                    <div class="bootstrap-timepicker">{!! Form::text('outlet_fri_start', $outlet->outlet_fri_start, ['id' => 'timepicker-fri-start-1', 'class' => 'toggle-timepicker-fri-active-toggle form-control time-sched']) !!}</div>
                                </div>
                                <div class="col-xs-1" style="width:40px;padding-top:12px;">
                                    <p style="text-align:center;">to</p>
                                </div>
                                <div class="col-xs-3 col-sm-2">
                                    <div class="bootstrap-timepicker">{!! Form::text('outlet_fri_end', $outlet->outlet_fri_end, ['id' => 'timepicker-fri-end-1', 'class' => 'toggle-timepicker-fri-active-toggle form-control time-sched']) !!}</div>
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
                                    <div class="bootstrap-timepicker">{!! Form::text('outlet_sat_start', $outlet->outlet_sat_start, ['id' => 'timepicker-sat-start-1', 'class' => 'toggle-timepicker form-control time-sched']) !!}</div>
                                </div>
                                <div class="col-xs-1" style="width:40px;padding-top:12px;">
                                    <p style="text-align:center;">to</p>
                                </div>
                                <div class="col-xs-3 col-sm-2">
                                    <div class="bootstrap-timepicker">{!! Form::text('outlet_sat_end', $outlet->outlet_sat_end, ['id' => 'timepicker-sat-end-1', 'class' => 'toggle-timepicker form-control time-sched']) !!}</div>
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
                                    <div class="bootstrap-timepicker">{!! Form::text('outlet_sun_start', $outlet->outlet_sun_start, ['id' => 'timepicker-sun-start-1', 'class' => 'toggle-timepicker form-control time-sched']) !!}</div>
                                </div>
                                <div class="col-xs-1" style="width:40px;padding-top:12px;">
                                    <p style="text-align:center;">to</p>
                                </div>
                                <div class="col-xs-3 col-sm-2">
                                    <div class="bootstrap-timepicker">{!! Form::text('outlet_sun_end', $outlet->outlet_sun_end, ['id' => 'timepicker-sun-end-1', 'class' => 'toggle-timepicker form-control time-sched']) !!}</div>
                                </div>
                            </div><!-- form-group -->

                            <div class="form-group openinghours-form">
                                <label class="col-xs-12 col-sm-2 control-label" style="text-align:left;"></label>

                                <div class="col-xs-1" style="width:50px;padding-top:12px;">
                                    <p>Ph</p>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2" style="max-width:80px;">
                                    <div class="toggle toggle-primary" id="ph-active-toggle"></div>
                                    <input name="outlet_ph_active" value="{{$outlet->outlet_ph_active}}" type="hidden" class="form-control ph-active-toggle" />
                                </div>
                                <div class="col-xs-3 col-sm-2">
                                    <div class="bootstrap-timepicker">{!! Form::text('outlet_ph_start', $outlet->outlet_ph_start, ['id' => 'timepicker-ph-start-1', 'class' => 'toggle-timepicker form-control time-sched']) !!}</div>
                                </div>
                                <div class="col-xs-1" style="width:40px;padding-top:12px;">
                                    <p style="text-align:center;">to</p>
                                </div>
                                <div class="col-xs-3 col-sm-2">
                                    <div class="bootstrap-timepicker">{!! Form::text('outlet_ph_end', $outlet->outlet_ph_end, ['id' => 'timepicker-ph-end-1', 'class' => 'toggle-timepicker form-control time-sched']) !!}</div>
                                </div>
                            </div><!-- form-group -->

                            <button type="submit" class="btn btn-primary">Update</button>
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
</script>
<script type="text/javascript">
     $(function(){
        $('.time-sched').inputmask("hh:mm", {
            //placeholder: "HH:MM",
            insertMode: false,
            showMaskOnHover: false,
            //hourFormat: 24
        });

        $(function() {
            $('td').on('keydown', '.bootstrap-timepicker-hour', function(e){-1!==$.inArray(e.keyCode,[46,8,9,27,13,110,190])||/65|67|86|88/.test(e.keyCode)&&(!0===e.ctrlKey||!0===e.metaKey)||35<=e.keyCode&&40>=e.keyCode||(e.shiftKey||48>e.keyCode||57<e.keyCode)&&(96>e.keyCode||105<e.keyCode)&&e.preventDefault()});

            $('td').on('keydown', '.bootstrap-timepicker-minute', function(e){-1!==$.inArray(e.keyCode,[46,8,9,27,13,110,190])||/65|67|86|88/.test(e.keyCode)&&(!0===e.ctrlKey||!0===e.metaKey)||35<=e.keyCode&&40>=e.keyCode||(e.shiftKey||48>e.keyCode||57<e.keyCode)&&(96>e.keyCode||105<e.keyCode)&&e.preventDefault()});
        });
    });
</script>
<script src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
<script type="text/javascript" src="{{asset('js/dropzone.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/toggles.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap-timepicker.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="//cdn.datatables.net/plug-ins/725b2a2115b/integration/bootstrap/3/dataTables.bootstrap.js"></script>
<!-- <script type="text/javascript" src="//cdn.datatables.net/responsive/1.10.11/js/dataTables.responsive.js"></script> -->
<script type="text/javascript" src="{{asset('js/jquery.prettyPhoto.js')}}"></script>
<script type="text/javascript" src="{{asset('js/holder.js')}}"></script>
<script type="text/javascript" src="{{asset('js/merchant/profile.js')}}"></script>

@endsection
