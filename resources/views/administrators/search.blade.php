@extends('layouts.admin')

@section('page-title', 'Administrators')

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
                                <li>Administrators</li>
                            </ul>
                            <h4>Administrators</h4>
                        </div>
                    </div><!-- media -->
                </div><!-- pageheader -->

                <div class="contentpanel">

                    <div class="row">
                        <div class="col-sm-3">

                            <h5 class="md-title">Administrators</h5>
                            <ul class="nav nav-pills nav-stacked nav-contacts">
                                <li class="@if(strpos(url()->current(), 'search')) active @endif">
                                    <a href="{{url('administrators')}}">
                                        <table><tr><td style="width:100%;">All Admin</td>
                                        <td><span class="badge pull-right">{{count($admins)}}</span></td></tr></table>
                                    </a>
                                </li>
                                <li class="@if(strpos(url()->current(), 'super-admin')) active @endif">
                                    <a href="{{url('administrators/category/super-admin')}}">
                                        <table><tr><td style="width:100%;">Super Admin</td>
                                        <td><span class="badge pull-right">{{count($admin_count)}}</span></td></tr></table>
                                    </a>
                                </li>
                                <li class="@if(strpos(url()->current(), 'admins')) active @endif">
                                    <a href="{{url('administrators/category/admins')}}">
                                        <table><tr><td style="width:100%;">Admin</td>
                                        <td><span class="badge pull-right">{{count($super_admin_count)}}</span></td></tr></table>
                                    </a>
                                </li>
                            </ul>

                            <hr />

                        </div><!-- col-sm-3 -->
                        <div class="col-sm-9">

                            <div class="well mt10">
                                <div class="row">
                                    <div class="col-sm-9">
                                        <input type="text" id="input" value="{{$search_word}}" placeholder="Who are you looking for?" class="form-control">
                                    </div>
                                    <div class="col-sm-3">
                                        <select id="search-type" class="width100p" data-placeholder="Search Type">
                                            <option value="">Choose One</option>
                                            <option value="First Name" <?php if ($search_type == "First Name"): ?> selected="selected" <?php endif;?> >First Name</option>
                                            <option value="Last Name" <?php if ($search_type == "Last Name"): ?> selected="selected" <?php endif;?>>Last Name</option>
											<option value="Position" <?php if ($search_type == "Position"): ?> selected="selected" <?php endif;?>>Position</option>
                                            <option value="Email" <?php if ($search_type == "Email"): ?> selected="selected" <?php endif;?>>Email</option>
                                        </select>
                                    </div>
                                </div>
                            </div><!-- well -->
							<a href="">
                                <button class="btn btn-info"><i class="fa fa-file-excel-o"></i>&nbsp;Download List (.csv)</button>
                            </a>
                            <a href="{{url('administrators/create')}}"><button class="btn btn-primary"><i class="fa fa-plus"></i> Add New Admin</button></a>

                            <hr />

                            <div class="pull-right">
                                @if ($administrators->lastPage() > 1)
                                <ul class="pagination pagination-split pagination-sm pagination-contact">
                                    <li class="{{ ($administrators->currentPage() == 1) ? ' disabled' : '' }}">
                                        <a href="{{ $administrators->url(1) }}"><i class="fa fa-angle-left"></i></a>
                                    </li>
                                    @for ($i = 1; $i <= $administrators->lastPage(); $i++)
                                        <li class="{{ ($administrators->currentPage() == $i) ? ' active' : '' }}">
                                            <a href="{{ $administrators->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor
                                    <li class="{{ ($administrators->currentPage() == $administrators->lastPage()) ? ' disabled' : '' }}">
                                        <a href="{{ ($administrators->currentPage() == $administrators->lastPage()) ? '#' : $administrators->url($administrators->currentPage()+1) }}" ><i class="fa fa-angle-right"></i></a>
                                    </li>
                                </ul>
                                @endif
                            </div>
                            <h3 class="xlg-title">All Admin</h3>
                            @if(count($administrators) == 0)<br>
                            <div class="alert alert-danger">
                                <strong>No results found.</strong>
                            </div>
                            @endif
                            <div class="list-group contact-group">
                            	@foreach($administrators as $admin)
                                <a href="{{url('administrators/'.$admin['id'])}}" class="list-group-item">
                                    <div class="media">
                                        <div class="pull-left">
                                        	@if($admin['profile_photo'] == null)
                                            <img class="img-circle img-online" src="{{asset('images/photos/profile-big.jpg')}}" alt="...">
                                            @else
                                            <img class="img-circle img-online" src="{{asset($admin['profile_photo'])}}" alt="...">
                                            @endif
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading">{{$admin['first_name']}} {{$admin['last_name']}}  <small>{{$admin['title']}}</small></h4>
                                            <div class="media-content">
                                                <i class="fa fa-clock-o"></i> Last online at {{date_format(date_create($admin['last_online']), 'd-M-Y H:i:s')}}
                                                <ul class="list-unstyled">
													<li><i class="fa fa-user-secret"></i> {{($admin['role_id'] == 1) ? 'Super Admin' : 'Admin'}}</li>
													<li><i class="fa fa-venus-mars"></i> {{$admin['gender']}}</li>
                                                    <li><i class="fa fa-calendar"></i> {{date_format(date_create($admin['date_of_birth']), 'd-M-Y')}}</li>
													<li><i class="fa fa-envelope-o"></i> {{$admin['email']}}</li>
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
			window.location.href = $('#search_url').val()+'/administrators/search/'+$('#input').val()+'/'+$(this).val();
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
