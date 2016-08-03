@extends('layouts.admin')

@section('page-title', 'Main')

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
	                        <i class="fa fa-star"></i>
	                    </div>
	                    <div class="media-body">
	                        <ul class="breadcrumb">
	                            <li><a href="{{url('dashboard')}}"><i class="glyphicon glyphicon-home"></i></a></li>
	                            <li>Featured Section</li>
	                        </ul>
	                        <h4>Featured Section</h4>
	                    </div>
	                </div><!-- media -->
	            </div><!-- pageheader -->

	            <div class="contentpanel">

	                <div class="row row-stat">
						<div class="col-md-12">
							<a href="{{url('/featured-section/create')}}"><button class="btn btn-primary"><i class="fa fa-plus"></i> Create New Featured Slide</button></a>
							<hr>
	                        <div class="table-responsive">
	                            <table class="table table-primary mb30" id="featured_section_table">
	                                <thead class="" style="background-color:#00B0ED">
	                                  <tr>
										<th>Position</th>
	                                    <th>Merchant Name</th>
										<th>Status</th>
										<th></th>
										<th></th>
	                                  </tr>
	                                </thead>
	                                <tbody>
	                                  	<tr>
	                                    	<td>{{$featured_section[0]['position']}}</td>
											<td>{{$featured_section[0]['merchant']['coy_name']}}</td>
											<td>{{$featured_section[0]['status']}}</td>
											<td class="table-action">&nbsp;&nbsp;&nbsp;&nbsp;
												<a href="{{ url('featured-section/move/'.$featured_section[0]['merchant_id'].'/'.$featured_section[0]['id'].'/down') }}" data-toggle="tooltip" title="Down" class="tooltips"><i class="fa fa-arrow-down"></i></a>
											</td>
											<td class="table-action">
												<a href="{{ url('featured-section/'.$featured_section[0]['id'].'/edit') }}" data-toggle="tooltip" title="Edit" class="tooltips"><i class="fa fa-pencil"></i></a>
											</td>
	                                  	</tr>

	                               		<tr>
	                                    	<td>{{$featured_section[1]['position']}}</td>
											<td>{{$featured_section[1]['merchant']['coy_name']}}</td>
											<td>{{$featured_section[1]['status']}}</td>
											<td class="table-action">&nbsp;&nbsp;&nbsp;&nbsp;
												<a href="{{ url('featured-section/move/'.$featured_section[1]['merchant_id'].'/'.$featured_section[1]['id'].'/down') }}" data-toggle="tooltip" title="Down" class="tooltips"><i class="fa fa-arrow-down"></i></a>
												<a href="{{ url('featured-section/move/'.$featured_section[1]['merchant_id'].'/'.$featured_section[1]['id'].'/up') }}" data-toggle="tooltip" title="Down" class="tooltips"><i class="fa fa-arrow-up"></i></a>
											</td>
											<td class="table-action">
												<a href="{{ url('featured-section/'.$featured_section[1]['id'].'/edit') }}" data-toggle="tooltip" title="Edit" class="tooltips"><i class="fa fa-pencil"></i></a>
											</td>
	                                  	</tr>

	                                  	<tr>
	                                    	<td>{{$featured_section[2]['position']}}</td>
											<td>{{$featured_section[2]['merchant']['coy_name']}}</td>
											<td>{{$featured_section[2]['status']}}</td>
											<td class="table-action">&nbsp;&nbsp;&nbsp;&nbsp;
												<a href="{{ url('featured-section/move/'.$featured_section[2]['merchant_id'].'/'.$featured_section[2]['id'].'/up') }}" data-toggle="tooltip" title="Down" class="tooltips"><i class="fa fa-arrow-up"></i></a>
											</td>
											<td class="table-action">
												<a href="{{ url('featured-section/'.$featured_section[2]['id'].'/edit') }}" data-toggle="tooltip" title="Edit" class="tooltips"><i class="fa fa-pencil"></i></a>
											</td>
	                                  	</tr>

	                                </tbody>
	                            </table>
	                        </div><!-- table-responsive -->
	                    </div>
	                </div><!-- row -->
	            </div><!-- contentpanel -->
	        </div><!-- mainpanel -->
	    </div><!-- mainwrapper -->
	</section>
@endsection

@section('custom-js')

<script type="text/javascript" src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="//cdn.datatables.net/plug-ins/725b2a2115b/integration/bootstrap/3/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js"></script>
<script>
    /*jQuery(document).ready(function(){

        jQuery('#featured_section_table').DataTable({
            responsive: true,
            order: [],
            "paging":   false,
	        "ordering": false,
	        "info":     false,
        });

        var shTable = jQuery('#shTable').DataTable({
            "fnDrawCallback": function(oSettings) {
                jQuery('#shTable_paginate ul').addClass('pagination-active-dark');
            },
            responsive: true
        });
    });*/
</script>

@endsection
