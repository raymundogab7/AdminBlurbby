@extends('layouts.admin')

@section('page-title', $restaurant->res_name . ' Campaigns')

@section('custom-css')

<link href="{{asset('css/toggles.css')}}" rel="stylesheet">
<link href="{{asset('css/bootstrap-timepicker.min.css')}}" rel="stylesheet">
<link href="{{asset('css/style.datatables.css')}}" rel="stylesheet">
<link href="//cdn.datatables.net/responsive/2.1.0/css/responsive.dataTables.min.css" rel="stylesheet">
<link href="{{asset('css/morris.css')}}" rel="stylesheet">

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
                            <li>Campaign Details</li>
                        </ul>
                        <h4>Campaign Details</h4>
                    </div>
                </div><!-- media -->
            </div><!-- pageheader -->
            
            <div class="contentpanel">
                <div class="panel panel-primary-head">
               	 	@if(session('message'))

                    <div class="alert alert-success">
                        <strong>{{session('message')}}</strong>
                    </div>

	                @endif

	                @if(session('message_error'))

                    <div class="alert alert-danger">
                        <strong>{{session('message_error')}}</strong>
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
					@if($campaign->cam_status == 'Rejected')

					@include('campaign._rejected', ['campaign' => $campaign])

					@elseif($campaign->cam_status == 'Draft')

					@include('campaign._draft', ['campaign' => $campaign])

					@elseif($campaign->cam_status == 'Approved')

					@include('campaign._approved', ['campaign' => $campaign])

					@elseif($campaign->cam_status == 'Live')

					@include('campaign._live', ['campaign' => $campaign])

					@elseif($campaign->cam_status == 'Expired')

					@include('campaign._expired', ['campaign' => $campaign])

					@else

					@include('campaign._pending_approval', ['campaign' => $campaign])

					@endif

                    
                </div><!-- panel -->
            </div><!-- contentpanel -->
        </div><!-- mainpanel -->
    </div><!-- mainwrapper -->
</section>

@endsection

@section('custom-js')






@endsection
