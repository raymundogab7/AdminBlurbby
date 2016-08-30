@extends('layouts.admin')

@section('page-title', 'Merchants')

@section('custom-css')

<link href="{{asset('css/morris.css')}}" rel="stylesheet">
<link href="{{asset('css/style.datatables.css')}}" rel="stylesheet">
<link href="//cdn.datatables.net/responsive/2.1.0/css/responsive.dataTables.min.css" rel="stylesheet">
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
	                            <li>Add New Merchant</li>
	                        </ul>
	                        <h4>Add New Merchant</h4>
	                    </div>
	                </div><!-- media -->
	            </div><!-- pageheader -->

	            <div class="contentpanel">
	            	<div class="col-sm-12 col-md-8 col-xs-12" style="padding-bottom:20px;">
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

			            @if(session('error'))

			                <div class="alert alert-danger">
			                    <strong>{{session('error')}}</strong>
			                </div>

			            @endif
			            <form action="{{url('merchants')}}" method="POST" class="form-horizontal form-bordered" style="display:inline;">
							<div class="form-group">
								<label class="col-sm-2 control-label" name="coy_name" style="text-align:left;">Company Name *</label>
								<div class="col-sm-8">
									<input type="hidden" name="_token" value="{{csrf_token()}}">
									<input type="text" value="" class="form-control" required />
								</div>
							</div><!-- form-group -->

							<div class="form-group">
								<label class="col-sm-2 control-label" style="text-align:left;">First Name *</label>
								<div class="col-sm-8">
									<input type="text" value="" name="first_name" class="form-control" required />
								</div>
							</div><!-- form-group -->

							<div class="form-group">
								<label class="col-sm-2 control-label" style="text-align:left;">Last Name *</label>
								<div class="col-sm-8">
									<input type="text" value="" name="last_name" class="form-control" required />
								</div>
							</div><!-- form-group -->

							<div class="form-group">
								<label class="col-sm-2 control-label" style="text-align:left;">Company Email Address *</label>
								<div class="col-sm-8">
                                        <input type="email" value="" name="coy_email" class="form-control" required />
								</div>
							</div><!-- form-group -->

							<div class="form-group">
								<label class="col-sm-2 control-label" style="text-align:left;">Contact Number *</label>
								<div class="col-sm-8">
                                        <input type="number" value="" name="coy_phone" class="form-control" required />
								</div>
							</div><!-- form-group -->

							<div class="form-group">
								<label class="col-sm-2 control-label" style="text-align:left;">Password *</label>
								<div class="col-sm-8">
                                        <input type="password" value="" name="password" class="form-control" required />
								</div>
							</div><!-- form-group -->

							<div class="form-group">
								<p class="col-sm-8">NOTE: Merchant will be required to update their profile completely before admin approval.</p>
							</div><!-- form-group -->


							<button style="margin-left:15px;" type="submit" class="btn btn-primary">Create Merchant</button>
							<a href="{{url('merchants')}}"><button style="margin-left:15px;" class="btn btn-default">Cancel</button></a>
						</form>

				    </div>
				</div>
			</div>
	    </div>
    </section>
@endsection

@section('custom-js')
<script type="text/javascript" src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="//cdn.datatables.net/plug-ins/725b2a2115b/integration/bootstrap/3/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js"></script>
<script>

</script>
@endsection
