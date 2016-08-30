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
	                        <i class="fa fa-tags"></i>
	                    </div>
	                    <div class="media-body">
	                        <ul class="breadcrumb">
	                            <li><a href="{{url('dashboard')}}"><i class="glyphicon glyphicon-home"></i></a></li>
	                            <li>Merchants</li>
	                        </ul>
	                        <h4>Merchants</h4>
	                    </div>
	                </div><!-- media -->
	            </div><!-- pageheader -->

	            <div class="contentpanel">

	                <div class="row">
	                    <div class="col-sm-3">

	                        <h5 class="md-title">Merchants</h5>
	                        <ul class="nav nav-pills nav-stacked nav-contacts">
	                            <li>
	                                <a href="{{url('merchants')}}">
	                                    <table><tr><td style="width:100%;">All Merchants</td>
	                                    <td><span class="badge pull-right">{{$total_merchants}}</span></td></tr></table>
	                                </a>
	                            </li>
	                            <li class="@if(strpos(url()->current(), 'month')) active @endif">
	                                <a href="{{url('merchants/category/month')}}">
	                                    <table><tr><td style="width:100%;">Created in the last 30 days</td>
	                                    <td><span class="badge pull-right">{{$total_last_thirty_days}}</span></td></tr></table>
	                                </a>
	                            </li>
	                            <li class="@if(strpos(url()->current(), 'approved')) active @endif">
	                                <a href="{{url('merchants/category/approved')}}">
	                                    <table><tr><td style="width:100%;">Approved</td>
	                                    <td><span class="badge pull-right">{{$total_approved_merchants}}</span></td></tr></table>
	                                </a>
	                            </li>
	                            <li class="@if(strpos(url()->current(), 'blocked')) active @endif">
	                                <a href="{{url('merchants/category/blocked')}}">
	                                    <table><tr><td style="width:100%;">Blocked</td>
	                                    <td><span class="badge pull-right">{{$total_blocked_merchants}}</span></td></tr></table>
	                                </a>
	                            </li>
	                            <li class="@if(strpos(url()->current(), 'pending-admin')) active @endif">
	                                <a href="{{url('merchants/category/pending-admin')}}">
	                                    <table><tr><td style="width:100%;">Pending Admin Approval</td>
	                                    <td><span class="badge pull-right">{{$total_pending_admin_approval_merchants}}</span></td></tr></table>
	                                </a>
	                            </li>
	                            <li class="@if(strpos(url()->current(), 'disabled')) active @endif">
	                                <a href="{{url('merchants/category/disabled')}}">
	                                    <table><tr><td style="width:100%;">Disabled</td>
	                                    <td><span class="badge pull-right">{{$total_disabled}}</span></td></tr></table>
	                                </a>
	                            </li>
	                        </ul>

	                        <hr />

	                    </div><!-- col-sm-3 -->
	                    <div class="col-sm-9">

	                        <div class="well mt10">
	                            <div class="row">
	                                <div class="col-sm-9">
	                                    <input type="text" id="input" placeholder="Who are you looking for?" class="form-control">
	                                </div>
	                                <div class="col-sm-3">
	                                    <select id="search-type" class="width100p" data-placeholder="Search Type">
	                                        <option value="">Choose One</option>
	                                        <option value="Company">Company Name</option>
	                                        <option value="Restaurant">Eatery Name</option>
	                                        <option value="Email">Email</option>
	                                    </select>
	                                </div>
	                            </div>
	                        </div><!-- well -->

							{!! Form::open(array('url' => '/merchants/report/generate', 'style' => 'display:inline;', 'class' => 'form-horizontal form-bordered')) !!}
								<button class="btn btn-info"><i class="fa fa-file-excel-o"></i>&nbsp;Download List (.csv)</button>
							{!! Form::close() !!}
							<a href="{{url('campaigns/create')}}">
								<button class="btn btn-primary"><i class="fa fa-plus"></i> Add New Campaign</button>
							</a>

	                        <hr />

	                        <div class="pull-right">

	                            @if ($merchants->lastPage() > 1)
								<ul class="pagination pagination-split pagination-sm pagination-contact">
								    <li class="{{ ($merchants->currentPage() == 1) ? ' disabled' : '' }}">
								        <a href="{{ $merchants->url(1) }}"><i class="fa fa-angle-left"></i></a>
								    </li>
								    @for ($i = 1; $i <= $merchants->lastPage(); $i++)
								        <li class="{{ ($merchants->currentPage() == $i) ? ' active' : '' }}">
								            <a href="{{ $merchants->url($i) }}">{{ $i }}</a>
								        </li>
								    @endfor
								    <li class="{{ ($merchants->currentPage() == $merchants->lastPage()) ? ' disabled' : '' }}">
								        <a href="{{ ($merchants->currentPage() == $merchants->lastPage()) ? '#' : $merchants->url($merchants->currentPage()+1) }}" ><i class="fa fa-angle-right"></i></a>
								    </li>
								</ul>
								@endif
	                        </div>
	                        <h3 class="xlg-title">{{$title}}</h3>
	                        @if(count($merchants) == 0)<br>
		                    <div class="alert alert-default">
		                        <strong>No data available.</strong>
		                    </div>
		                    @endif
	                        <div class="list-group contact-group">
	                        	@foreach($merchants as $merchant)
	                            <a href="{{url('merchants/'.$merchant['id'].'/edit')}}" class="list-group-item">
	                                <div class="media">
	                                    <div class="pull-left">

	                                        @if(!is_null($merchant['restaurant']['res_logo']))
	                                        @if($merchant['restaurant']['photo_location'] == 'merchant')
			                                <img class="img-roundedcircle img-online" src="{{env('MERCHANT_URL').'/'.$merchant['restaurant']['res_logo']}}" alt="...">
			                                @else
			                                <img class="img-roundedcircle img-online" src="{{asset($merchant['restaurant']['res_logo'])}}" alt="...">
			                                @endif
	                                    	@else
	                                        <img class="img-roundedcircle img-online" src="{{env('APP_URL')}}/images/photos/user1.png" alt="...">
	                                        @endif
	                                    </div>
	                                    <div class="media-body">
	                                        <h4 class="media-heading">{{$merchant['restaurant']['res_name']}}</h4>
	                                        <div class="media-content">
	                                            <i class="fa fa-clock-o"></i> Last online at {{date_format(date_create($merchant['last_online']), 'd-M-Y H:i:s')}}
	                                            <ul class="list-unstyled">
													<li><i class="fa fa-briefcase"></i> {{$merchant['coy_name']}}</li>
													<li><i class="fa fa-toggle-on"></i>
													@if($merchant['status'] == 1)
					                            	<span class="text-success"><strong>Approved</strong>
					                            	@elseif($merchant['status'] == 2)
					                            	<span class="text-muted"><strong>Blocked</strong>
					                            	@elseif($merchant['status'] == 3)
					                            	<span class="text-muted"><strong>Disabled</strong>
					                            	@elseif($merchant['status'] == 0)
					                            	<span class="text-warning"><strong>Pending Admin Approval</strong>

					                            	@endif
													</span></small></li>

	                                            	<li><i class="fa fa-phone"></i> {{$merchant['coy_phone']}}</li>
													<li><i class="fa fa-envelope-o"></i> {{$merchant['email']}}</li>
	                                            </ul>
	                                        </div>
	                                    </div>
	                                </div><!-- media -->
	                            </a><!-- list-group -->
	                            @endforeach
	                        </div><!-- list-group -->
	                    </div><!-- col-sm-9 -->
	                </div><!-- row -->
	            </div><!-- contentpanel -->
			</div><!-- mainpanel -->
	    </div><!-- mainwrapper -->
	</section>
	<input type="hidden" id="search_url" value="{{url('')}}">
@endsection

@section('custom-js')
<script type="text/javascript" src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="//cdn.datatables.net/plug-ins/725b2a2115b/integration/bootstrap/3/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js"></script>
<script>
	jQuery('#search-type').select2({
        minimumResultsForSearch: -1
    });
	$('#search-type').change(function(){
		/*$.ajax({
			url: '/merchants/search/'+ $('#input').val() + '/'+ $(this).val(),
			success:function(data){
				console.log(data);
			}
		});*/
		if($(this).val() != "" && $('#input').val() != "") {
			window.location.href = $('#search_url').val()+'/merchants/search/'+$('#input').val()+'/'+$(this).val();
		}


	})

    jQuery(document).ready(function(){

        jQuery('#live_merchants_table').DataTable({
            responsive: true,
            order: []
        });

        var shTable = jQuery('#shTable').DataTable({
            "fnDrawCallback": function(oSettings) {
                jQuery('#shTable_paginate ul').addClass('pagination-active-dark');
            },
            responsive: true
        });
    });
</script>
@endsection
