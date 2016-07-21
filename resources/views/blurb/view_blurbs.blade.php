@extends('layouts.admin')



@if($campaign->cam_status == 'Draft' && $campaign->cam_status == 'Rejected')
@section('page-title', $restaurant->res_name . ' Edit Blurb')
@else
@section('page-title', $restaurant->res_name . ' View Blurb')
@endif

@section('custom-css')

<link href="{{asset('css/style.datatables.css')}}" rel="stylesheet">
<link href="//cdn.datatables.net/responsive/2.1.0/css/responsive.dataTables.min.css" rel="stylesheet">

@endsection


@section('body-contents')

<section>
    <div class="mainwrapper">

        @include('layouts.sidebar-admin', ['restaurant' => $restaurant])

        <div class="mainpanel">
            <div class="pageheader">
                <div class="media">
                    <div class="pageicon pull-left">
                        <i class="fa fa-tag"></i>
                    </div>
                    <div class="media-body">
                        <ul class="breadcrumb">
                            <li><a href="{{url('dashboard')}}"><i class="glyphicon glyphicon-home"></i></a></li>
                            <li><a href="{{url('campaigns')}}">Campaigns</a></li>
                            <li><a href="{{url('campaigns/'.$campaign->id)}}">{{$campaign->campaign_name}}</a></li>
                            @if($campaign->cam_status == 'Draft' || $campaign->cam_status == 'Rejected')
                            <li>Edit Blurb</li>
                            @else
                            <li>View Blurb</li>
                            @endif
                        </ul>
                        @if($campaign->cam_status == 'Draft' || $campaign->cam_status == 'Rejected')
                        <h4>Edit Blurb</h4>
                        @else
                        <h4>View Blurb</h4>
                        @endif

                    </div>
                </div><!-- media -->
            </div><!-- pageheader -->

             <div class="contentpanel">
                <div class="panel panel-primary-head">

                    <div class="col-sm-12 col-md-12 col-xs-12" style="padding-bottom:20px;">
                        <table id="view_blurbs" class="table table-striped table-bordered responsive">
                            <thead class="">
                                <tr>
                                    <th>Blurb Image</th>
                                    <th>Blurb Title</th>
                                    <th>Status</th>
                                    <th>Category</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($blurbs as $blurb)
                                <tr>
                                    @if(!is_null($blurb['blurb_logo']))
                                    @if($blurb['photo_location'] == 'merchant')
                                    <td><img src="{{env('MERCHANT_URL').'/'.$blurb['blurb_logo']}}" style="width:20px"></td>
                                    @else
                                    <td><img src="{{asset($blurb['blurb_logo'])}}" style="width:20px"></td>
                                    @endif
                                    @else
                                    <td><!-- <img src="{{asset('images/no-blurb.png')}}" style="width:20px">  -->No Image Available</td>
                                    @endif

                                    <td><a href="{{url('blurb/'.$blurb['id'].'/'.$campaign['control_no'])}}">{{$blurb['blurb_name']}}</a></td>
                                    <td>
                                        @if($blurb['blurb_status'] == 'Approved')
                                        <span class="text-success">
                                        @elseif($blurb['blurb_status'] == 'Created')
                                        <span class="text-info">
                                        @elseif($blurb['blurb_status'] == 'Live')
                                        <span class="text-success">
                                        @elseif($blurb['blurb_status'] == 'Expired')
                                        <span class="text-muted">
                                        @elseif($blurb['blurb_status'] == 'Rejected')
                                        <span class="text-danger">
                                        @else
                                        <span class="text-warning">
                                        @endif
                                        <strong>{{$blurb['blurb_status']}}</strong>
                                        </span>
                                    </td>
                                    <td>{{$blurb['blurb_category']}}</td>
                                    <td>{{date_format(date_create($blurb['blurb_start']), 'd-M-Y')}}</td>
                                    <td>{{date_format(date_create($blurb['blurb_end']), 'd-M-Y')}}</td>
                                    <td class="table-action">
                                    @if($blurb['blurb_status'] == 'Rejected' || $blurb['blurb_status'] == 'Created')

                                        <a href="{{url('blurb/'.$blurb['id'].'/'.$campaign['control_no'])}}" data-toggle="tooltip" title="Edit" class="tooltips"><i class="fa fa-pencil"></i></a>
                                        <a href="#deleteBlurbModal" data-blurb-id="{{$blurb['id']}}" data-blurb-name="{{$blurb['blurb_name']}}" data-target="#deleteBlurbModal" data-toggle="modal" title="Delete" class="tooltips"><i class="fa fa-trash-o"></i></a>
                                    @else

                                        <a href="{{url('blurb/'.$blurb['id'].'/'.$campaign->control_no)}}" data-toggle="tooltip" title="View" class="tooltips"><i class="fa fa-eye"></i></a>
                                    @endif


                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><!-- col-sm-4 col-md-3 -->

                </div>
                <div class="col-sm-12 col-md-12 col-xs-12" style="padding-bottom:20px;">
                    <a href="{{url('campaigns/'.$campaign->id)}}"><button class="btn btn-default">Back</button></a>
                </div>

            </div><!-- contentpanel -->

        </div>
    </div><!-- mainwrapper -->
</section>

@endsection

@section('custom-js')
    <script>
    jQuery(document).ready(function(){

        jQuery('#view_blurbs').DataTable({
            responsive: true,
            order:[]
        });

        var shTable = jQuery('#shTable').DataTable({
            "fnDrawCallback": function(oSettings) {
                jQuery('#shTable_paginate ul').addClass('pagination-active-dark');
            },
            responsive: true
        });
    });
</script>

<script type="text/javascript" src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="//cdn.datatables.net/plug-ins/725b2a2115b/integration/bootstrap/3/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js"></script>

@endsection
