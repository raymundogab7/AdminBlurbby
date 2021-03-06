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
                            <i class="fa fa-home"></i>
                        </div>
                        <div class="media-body">
                            <ul class="breadcrumb">
                                <li><a href="{{url('dashboard')}}"><i class="glyphicon glyphicon-home"></i></a></li>
                                <li>Dashboard</li>
                            </ul>
                            <h4>Dashboard</h4>
                        </div>
                    </div><!-- media -->
                </div><!-- pageheader -->

                <div class="contentpanel">

                    <div class="row row-stat">
                        <div class="col-md-4">
                            <div class="panel panel-success-alt noborder">
                                <div class="panel-heading noborder">
                                    <div class="panel-icon"><i class="fa fa-heart"></i></div>
                                    <div class="media-body">
                                        <h5 class="md-title nomargin">Total Blurbs Likes</h5>
                                        <h1 class="mt5">{{number_format($totalSnapShotLikes, 0)}}</h1>
                                    </div><!-- media-body -->
                                    <hr>
                                    <div class="clearfix mt20">
                                        <div class="pull-left">
                                            <h5 class="md-title nomargin">Last Week</h5>
                                            <h4 class="nomargin">{{number_format($lastWeekTotalLikes, 0)}}</h4>
                                        </div>
                                        <div class="pull-right">
                                            <h5 class="md-title nomargin">This Week</h5>
                                            <h4 class="nomargin">{{number_format($thisWeekTotalLikes, 0)}}</h4>
                                        </div>
                                    </div>

                                </div><!-- panel-body -->
                            </div><!-- panel -->
                        </div><!-- col-md-4 -->

                        <div class="col-md-4">
                            <div class="panel panel-primary noborder">
                                <div class="panel-heading noborder">
                                    <div class="panel-icon"><i class="fa fa-users"></i></div>
                                    <div class="media-body">
                                        <h5 class="md-title nomargin">Unique Views</h5>
                                        <h1 class="mt5">{{number_format($uniqueViews, 0)}}</h1>
                                    </div><!-- media-body -->
                                    <hr>
                                    <div class="clearfix mt20">
                                        <div class="pull-left">
                                            <h5 class="md-title nomargin">Last Week</h5>
                                            <h4 class="nomargin">{{number_format($lastWeekTotalViews, 0)}}</h4>
                                        </div>
                                        <div class="pull-right">
                                            <h5 class="md-title nomargin">This Week</h5>
                                            <h4 class="nomargin">{{number_format($thisWeekTotalViews, 0)}}</h4>
                                        </div>
                                    </div>

                                </div><!-- panel-body -->
                            </div><!-- panel -->
                        </div><!-- col-md-4 -->

                        <div class="col-md-4">
                            <div class="panel panel-warning-alt noborder">
                                <div class="panel-heading noborder">
                                    <div class="panel-icon"><i class="fa fa-check"></i></div>
                                    <div class="media-body">
                                        <h5 class="md-title nomargin">Total Blurbs Usage</h5>
                                        <h1 class="mt5">{{number_format($blurbsUsage, 0)}}</h1>
                                    </div><!-- media-body -->
                                    <hr>
                                    <div class="clearfix mt20">
                                        <div class="pull-left">
                                            <h5 class="md-title nomargin">Last Week</h5>
                                            <h4 class="nomargin">{{number_format($lastWeekTotalUsage, 0)}}</h4>
                                        </div>
                                        <div class="pull-right">
                                            <h5 class="md-title nomargin">This Week</h5>
                                            <h4 class="nomargin">{{number_format($thisWeekTotalUsage, 0)}}</h4>
                                        </div>
                                    </div>

                                </div><!-- panel-body -->
                            </div><!-- panel -->
                        </div><!-- col-md-4 -->
                    </div><!-- row -->

					<div class="row row-stat">
                        <div class="col-md-4">
                            <div class="panel panel-success-dark noborder">
                                <div class="panel-heading noborder">
                                    <div class="panel-icon"><i class="fa fa-cutlery"></i></div>
                                    <div class="media-body">
                                        <h5 class="md-title nomargin">Total Merchants</h5>
                                        <h1 class="mt5">{{number_format($totalMerchants, 0)}}</h1>
                                    </div><!-- media-body -->
                                    <hr>
                                    <div class="clearfix mt20">
                                        <div class="pull-left">
                                            <h5 class="md-title nomargin">Last Week</h5>
                                            <h4 class="nomargin">{{number_format($lastWeekMerchants, 0)}}</h4>
                                        </div>
                                        <div class="pull-right">
                                            <h5 class="md-title nomargin">This Week</h5>
                                            <h4 class="nomargin">{{number_format($thisWeekMerchants, 0)}}</h4>
                                        </div>
                                    </div>

                                </div><!-- panel-body -->
                            </div><!-- panel -->
                        </div><!-- col-md-4 -->

                        <div class="col-md-4">
                            <div class="panel panel-info-alt noborder">
                                <div class="panel-heading noborder">
                                    <div class="panel-icon"><i class="fa fa-user"></i></div>
                                    <div class="media-body">
                                        <h5 class="md-title nomargin">Total App Users</h5>
                                        <h1 class="mt5">{{number_format($totalAppUser, 0)}}</h1>
                                    </div><!-- media-body -->
                                    <hr>
                                    <div class="clearfix mt20">
                                        <div class="pull-left">
                                            <h5 class="md-title nomargin">Last Week</h5>
                                            <h4 class="nomargin">{{number_format($lastWeekAppUser, 0)}}</h4>
                                        </div>
                                        <div class="pull-right">
                                            <h5 class="md-title nomargin">This Week</h5>
                                            <h4 class="nomargin">{{number_format($thisWeekAppUser, 0)}}</h4>
                                        </div>
                                    </div>

                                </div><!-- panel-body -->
                            </div><!-- panel -->
                        </div><!-- col-md-4 -->

                        <div class="col-md-4">
                            <div class="panel panel-danger-alt noborder">
                                <div class="panel-heading noborder">
                                    <div class="panel-icon"><i class="fa fa-tags"></i></div>
                                    <div class="media-body">
                                        <h5 class="md-title nomargin">Current Live Campaigns</h5>
                                        <h1 class="mt5">{{number_format($totalLiveCampaigns, 0)}}</h1>
                                    </div><!-- media-body -->
                                    <hr>
                                    <div class="clearfix mt20">
                                        <div class="pull-left">
                                            <h5 class="md-title nomargin">Last Week</h5>
                                            <h4 class="nomargin">{{number_format($lastWeekTotalLiveCampaignLikes, 0)}}</h4>
                                        </div>
                                        <div class="pull-right">
                                            <h5 class="md-title nomargin">This Week</h5>
                                            <h4 class="nomargin">{{number_format($thisWeekTotalLiveCampaignLikes, 0)}}</h4>
                                        </div>
                                    </div>

                                </div><!-- panel-body -->
                            </div><!-- panel -->
                        </div><!-- col-md-4 -->
                    </div><!-- row -->
					<hr>
                    <div class="row">
						<div class="col-md-12">
							<h2>Live Campaigns</h2>
                            {!! Form::open(array('url' => 'dashboard/report/generate', 'style' => 'display:inline;', 'class' => 'form-horizontal form-bordered')) !!}
                                <button class="btn btn-info" style="float:right;margin-bottom:20px;"><i class="fa fa-file-excel-o"></i>&nbsp;Download Analytics Report (.csv)</button>
                            {!! Form::close() !!}

                            <div class="table-responsive">
                                <table class="table table-primary" id="live_campaigns_table">
                                    <thead class="" style="background-color:#00B0ED">
                                        <tr>
                                        	<th>Eatery Name</th>
                                            <th>Campaign Name</th>
                                            <th>Status</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>No. of Blurbs</th>
                                            <th>No. of Likes</th>
                                            <th>No. of Unique Views</th>
                                            <th>No. of Usage</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($campaigns as $c)
                                        <tr>
                                        	<td><a href="{{url('merchants') . '/' . $c['merchant_id'].'/edit'}}">{{$c['restaurant']['res_name']}}</a></td>
                                            <td><a href="{{url('campaigns') . '/' . $c['id']}}">{{$c['campaign_name']}}</a></td>
                                            <td>
                                                @if($c['cam_status'] == 'Approved')
                                                <span class="text-success">
                                                @elseif($c['cam_status'] == 'Draft')
                                                <span class="text-info">
                                                @elseif($c['cam_status'] == 'Live')
                                                <span class="text-success">
                                                @elseif($c['cam_status'] == 'Rejected')
                                                <span class="text-danger">
                                                @elseif($c['cam_status'] == 'Expired')
                                                <span class="text-muted">
                                                @else
                                                <span class="text-warning">
                                                @endif

                                                <strong>{{$c['cam_status']}}</strong>
                                                </span>
                                            </td>
                                            <td>{{date_format(date_create($c['cam_start']), "M-d-Y")}}</td>
                                            <td>{{date_format(date_create($c['cam_end']), "M-d-Y")}}</td>
                                            <td>{{count($c['blurb'])}}</td>
                                            <td>{{ \Admin\SnapShot::where(['campaign_id' => $c['id'], 'merchant_id' => $c['merchant_id']])->sum('snapshot_likes')}}</td>
                                            <td>{{ \Admin\SnapShot::where(['campaign_id' => $c['id'], 'merchant_id' => $c['merchant_id']])->sum('snapshot_uviews')}}</td>
                                            <td>{{ \Admin\SnapShot::where(['campaign_id' => $c['id'], 'merchant_id' => $c['merchant_id']])->sum('snapshot_usage')}}</td>
                                            <td class="table-action">

                                                @if($c['cam_status'] == 'Rejected' || $c['cam_status'] == 'Draft')

                                                <a href="{{url('campaigns') . '/' . $c['id']}}" data-toggle="tooltip" title="Edit" class="tooltips"><i class="fa fa-pencil"></i></a>

                                                @else

                                                <a href="{{url('campaigns') . '/' . $c['id']}}" data-toggle="tooltip" title="View" class="tooltips"><i class="fa fa-eye"></i></a>

                                                @endif

                                            </td>
                                        </tr>

                                    @endforeach

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
    jQuery(document).ready(function(){

        jQuery('#live_campaigns_table').DataTable({
            responsive: true,
            order: [],
            "bFilter": false,
            "bInfo": false,
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
