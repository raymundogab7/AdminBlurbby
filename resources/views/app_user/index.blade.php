@extends('layouts.admin')

@section('page-title', 'Users')

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
                            <i class="fa fa-user-secret"></i>
                        </div>
                        <div class="media-body">
                            <ul class="breadcrumb">
                                <li><a href="{{url('dashboard')}}"><i class="glyphicon glyphicon-home"></i></a></li>
                                <li>Users</li>
                            </ul>
                            <h4>Users</h4>
                        </div>
                    </div><!-- media -->
                </div><!-- pageheader -->

                <div class="contentpanel">

                    <div class="row">
                        <div class="col-sm-3">

                            <h5 class="md-title">Users</h5>
                            <ul class="nav nav-pills nav-stacked nav-contacts">
                                    <li class="active">
                                        <a href="#">
                                            <table><tr><td style="width:100%;">All App Users</td>
                                            <td><span class="badge pull-right">{{$total_app_users}}</span></td></tr></table>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <table><tr><td style="width:100%;">Used at least a blurb in the last 30 days</td>
                                            <td><span class="badge pull-right">1</span></td></tr></table>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <table><tr><td style="width:100%;">Online in the last 30 days</td>
                                            <td><span class="badge pull-right">{{$total_last_online_thirty_days}}</span></td></tr></table>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <table><tr><td style="width:100%;">Registered in the last 30 days</td>
                                            <td><span class="badge pull-right">{{$total_registered_last_thirty_days}}</span></td></tr></table>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <table><tr><td style="width:100%;">Approved</td>
                                            <td><span class="badge pull-right">{{$total_approved_app_users}}</span></td></tr></table>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <table><tr><td style="width:100%;">Blocked</td>
                                            <td><span class="badge pull-right">{{$total_blocked_app_users}}</span></td></tr></table>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <table><tr><td style="width:100%;">Pending Email Verification</td>
                                            <td><span class="badge pull-right">{{$total_pending_app_users}}</span></td></tr></table>
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
                                            <option value="First Name">First Name</option>
                                            <option value="Last Name">Last Name</option>
                                            <option value="Email">Email</option>
                                        </select>
                                    </div>
                                </div>
                            </div><!-- well -->
                            {!! Form::open(array('url' => 'app-users/generate', 'style' => 'display:inline;', 'class' => 'form-horizontal form-bordered')) !!}
                                <button class="btn btn-info"><i class="fa fa-file-excel-o"></i>&nbsp;Download List (.csv)</button>
                            {!! Form::close() !!}
                            <a href="{{url('app-users/create')}}">
                                <button class="btn btn-primary"><i class="fa fa-plus"></i> Add New App User</button>
                            </a>
                            <hr />
                            <div class="pull-right">
                                @if ($app_user_paginate->lastPage() > 1)
                                <ul class="pagination pagination-split pagination-sm pagination-contact">
                                    <li class="{{ ($app_user_paginate->currentPage() == 1) ? ' disabled' : '' }}">
                                        <a href="{{ $app_user_paginate->url(1) }}"><i class="fa fa-angle-left"></i></a>
                                    </li>
                                    @for ($i = 1; $i <= $app_user_paginate->lastPage(); $i++)
                                        <li class="{{ ($app_user_paginate->currentPage() == $i) ? ' active' : '' }}">
                                            <a href="{{ $app_user_paginate->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor
                                    <li class="{{ ($app_user_paginate->currentPage() == $app_user_paginate->lastPage()) ? ' disabled' : '' }}">
                                        <a href="{{ ($app_user_paginate->currentPage() == $app_user_paginate->lastPage()) ? '#' : $app_user_paginate->url($app_user_paginate->currentPage()+1) }}" ><i class="fa fa-angle-right"></i></a>
                                    </li>
                                </ul>
                                @endif
                            </div>
                            <h3 class="xlg-title">All Admin</h3>

                            <div class="list-group contact-group">
                            	@foreach($app_user_paginate as $user)
                                <a href="{{url('app-users/'.$user['id'].'/edit')}}" class="list-group-item">
                                    <div class="media">
                                        <div class="pull-left">
                                        	@if($user['photo'] == null || $user['photo'] == '')
                                            <img class="img-circle img-online" src="{{asset('images/photos/user1.png')}}" alt="...">
                                            @else
                                            <img class="img-circle img-online" src="{{asset('app_user_profile_photo/'.$user['id'].'/'.$user['id']. '.jpg')}}" alt="...">
                                            @endif
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading">{{$user['first_name']}} {{$user['last_name']}}  <small>{{$user['title']}}</small></h4>
                                            <div class="media-content">
                                                <i class="fa fa-clock-o"></i> Last online at {{date_format(date_create($user['last_online']), 'd-M-Y H:i:s')}}
                                                <ul class="list-unstyled">
													<li><i class="fa fa-toggle-on"></i>
                                                    @if($user['status'] == 'Approved')
                                                    <span class="text-success">
                                                    @elseif($user['status'] == 'Blocked')
                                                    <span class="text-muted">
                                                    @else
                                                    <span class="text-warning">
                                                    @endif
                                                    <strong>{{$user['status']}}</strong>
                                                    </span></small></li>
													<li><i class="fa fa-venus-mars"></i> {{$user['gender']}}</li>
                                                    <li><i class="fa fa-calendar"></i> {{date_format(date_create($user['date_of_birth']), 'd-M-Y')}}</li>
													<li><i class="fa fa-envelope-o"></i> {{$user['email']}}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div><!-- media -->
                                </a><!-- list-group -->
                                @endforeach
                        </div><!-- col-sm-9 -->
                    </div><!-- row -->

                </div><!-- contentpanel -->
			</div><!-- mainpanel -->
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
		if($(this).val() != "" && $('#input').val() != "") {
			window.location.href = $('#search_url').val()+'/app-users/search/'+$('#input').val()+'/'+$(this).val();
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
