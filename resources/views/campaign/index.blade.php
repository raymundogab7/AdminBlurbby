@extends('layouts.admin')

@section('page-title', 'Campaigns')

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
	                            <li>Campaigns</li>
	                        </ul>
	                        <h4>Campaigns</h4>
	                    </div>
	                </div><!-- media -->
	            </div><!-- pageheader -->

	            <div class="contentpanel">

	                <div class="row">
	                    <div class="col-sm-3">

	                        <h5 class="md-title">Campaigns</h5>
	                        <ul class="nav nav-pills nav-stacked nav-contacts">
	                            <li class="active">
	                                <a href="#">
	                                    <table><tr><td style="width:100%;">All Campaigns</td>
	                                    <td><span class="badge pull-right">{{$total_campaigns}}</span></td></tr></table>
	                                </a>
	                            </li>
	                            <li>
	                                <a href="#">
	                                    <table><tr><td style="width:100%;">Created in the last 30 days</td>
	                                    <td><span class="badge pull-right">{{$total_last_thirty_days}}</span></td></tr></table>
	                                </a>
	                            </li>
	                            <li>
	                                <a href="#">
	                                    <table><tr><td style="width:100%;">Live</td>
	                                    <td><span class="badge pull-right">{{$total_live_campaigns}}</span></td></tr></table>
	                                </a>
	                            </li>
	                            <li>
	                                <a href="#">
	                                    <table><tr><td style="width:100%;">Approved</td>
	                                    <td><span class="badge pull-right">{{$total_approved_campaigns}}</span></td></tr></table>
	                                </a>
	                            </li>
	                            <li>
	                                <a href="#">
	                                    <table><tr><td style="width:100%;">Rejected</td>
	                                    <td><span class="badge pull-right">{{$total_rejected_campaigns}}</span></td></tr></table>
	                                </a>
	                            </li>
	                            <li>
	                                <a href="#">
	                                    <table><tr><td style="width:100%;">Pending Approval</td>
	                                    <td><span class="badge pull-right">{{$total_pending_approval_campaigns}}</span></td></tr></table>
	                                </a>
	                            </li>
	                            <li>
	                                <a href="#">
	                                    <table><tr><td style="width:100%;">Draft</td>
	                                    <td><span class="badge pull-right">{{$total_draft_campaigns}}</span></td></tr></table>
	                                </a>
	                            </li>
	                            <li>
	                                <a href="#">
	                                    <table><tr><td style="width:100%;">Expired</td>
	                                    <td><span class="badge pull-right">{{$total_expired_campaigns}}</span></td></tr></table>
	                                </a>
	                            </li>
	                        </ul>

	                        <hr />

	                    </div><!-- col-sm-3 -->
	                    <div class="col-sm-9">

	                        <div class="well mt10">
	                            <div class="row">
	                                <div class="col-sm-9">
	                                    <input type="text" id="input" placeholder="Which campaign are you looking for?" class="form-control">
	                                </div>
	                                <div class="col-sm-3">
	                                    <select id="search-type" class="width100p" data-placeholder="Search Type">
	                                        <option value="">Choose One</option>
	                                        <option value="Campaign">Campaign Name</option>
	                                        <option value="Restaurant">Restaurant Name</option>
	                                        <option value="Company">Company Name</option>
	                                    </select>
	                                </div>
	                            </div>
	                        </div><!-- well -->
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
							{!! Form::open(array('url' => 'campaigns/report/generate', 'style' => 'display:inline;', 'class' => 'form-horizontal form-bordered')) !!}
								<button class="btn btn-info"><i class="fa fa-file-excel-o"></i>&nbsp;Download List (.csv)</button>
							{!! Form::close() !!}
							<a href="{{url('/campaigns/create')}}">
								<button class="btn btn-primary"><i class="fa fa-plus"></i> Add New Campaign</button>
							</a>

	                        <hr />

	                        <div class="pull-right">

	                            @if ($campaigns->lastPage() > 1)
								<ul class="pagination pagination-split pagination-sm pagination-contact">
								    <li class="{{ ($campaigns->currentPage() == 1) ? ' disabled' : '' }}">
								        <a href="{{ $campaigns->url(1) }}"><i class="fa fa-angle-left"></i></a>
								    </li>
								    @for ($i = 1; $i <= $campaigns->lastPage(); $i++)
								        <li class="{{ ($campaigns->currentPage() == $i) ? ' active' : '' }}">
								            <a href="{{ $campaigns->url($i) }}">{{ $i }}</a>
								        </li>
								    @endfor
								    <li class="{{ ($campaigns->currentPage() == $campaigns->lastPage()) ? ' disabled' : '' }}">
								        <a href="{{ ($campaigns->currentPage() == $campaigns->lastPage()) ? '#' : $campaigns->url($campaigns->currentPage()+1) }}" ><i class="fa fa-angle-right"></i></a>
								    </li>
								</ul>
								@endif
	                        </div>
	                        <h3 class="xlg-title">All Campaigns</h3>

	                        <div class="list-group contact-group">
	                        	@foreach($campaigns as $campaign)
	                            <a href="{{url('campaigns/'.$campaign['id'])}}" class="list-group-item">
	                                <div class="media">
	                                    <div class="pull-left">
	                                    	@if(!is_null($campaign['restaurant']['res_logo']))
	                                    	@if($campaign['restaurant']['photo_location'] == 'merchant')
			                                <img class="img-roundedcircle img-online" src="{{env('MERCHANT_URL').'/'.$campaign['restaurant']['res_logo']}}/profile_picture.jpg" alt="...">
			                                @else
			                                <img class="img-roundedcircle img-online" src="{{asset($campaign['restaurant']['res_logo'].'/profile_picture.jpg')}}" alt="...">
			                                @endif
	                                    	@else
	                                        <img class="img-roundedcircle img-online" src="{{env('APP_URL')}}/images/photos/user1.png" alt="...">
	                                        @endif
	                                    </div>
	                                    <div class="media-body">
	                                        <h4 class="media-heading">{{$campaign['campaign_name']}}</h4>
	                                        <div class="media-content">
	                                            <i class="fa fa-calendar"></i> <strong>{{date_format(date_create($campaign['cam_start']), 'd-M-Y')}}</strong> to <strong>{{date_format(date_create($campaign['cam_end']), 'd-M-Y')}}</strong>
	                                            <ul class="list-unstyled">
													<li><i class="fa fa-cutlery"></i> {{$campaign['merchant']['coy_name']}}</li>
													<li><i class="fa fa-toggle-on"></i>
													@if($campaign['cam_status'] == 'Approved')
					                            	<span class="text-success">
					                            	@elseif($campaign['cam_status'] == 'Draft')
					                            	<span class="text-info">
					                            	@elseif($campaign['cam_status'] == 'Live')
					                            	<span class="text-success">
					                            	@elseif($campaign['cam_status'] == 'Rejected')
					                            	<span class="text-danger">
					                            	@elseif($campaign['cam_status'] == 'Expired')
					                            	<span class="text-muted">
					                            	@else
					                            	<span class="text-warning">
					                            	@endif
													<strong>{{$campaign['cam_status']}}</strong></span></small></li>
	                                                <li><i class="fa fa-tags"></i> {{ \Admin\Blurb::where('campaign_id', $campaign['id'])->count()}} blurbs</li>
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
			url: '/campaigns/search/'+ $('#input').val() + '/'+ $(this).val(),
			success:function(data){
				console.log(data);
			}
		});*/
		if($(this).val() != "" && $('#input').val() != "") {
			window.location.href = $('#search_url').val()+'/campaigns/search/'+$('#input').val()+'/'+$(this).val();
		}


	})

    jQuery(document).ready(function(){

        jQuery('#live_campaigns_table').DataTable({
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
