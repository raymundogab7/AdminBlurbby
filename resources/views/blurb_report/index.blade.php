@extends('layouts.admin')

@section('page-title', 'Reports')

@section('custom-css')


@endsection

@section('body-contents')

<section>
    <div class="mainwrapper">

        @include('layouts.sidebar-admin')

        <div class="mainpanel">
            <div class="pageheader">
                <div class="media">
                    <div class="pageicon pull-left">
                        <i class="fa fa-exclamation-circle"></i>
                    </div>
                    <div class="media-body">
                        <ul class="breadcrumb">
                            <li><a href="{{url('dashboard')}}"><i class="glyphicon glyphicon-home"></i></a></li>
                            <li>Reports</li>
                        </ul>
                        <h4>Reports</h4>
                    </div>
                </div><!-- media -->
            </div><!-- pageheader -->
            <div class="contentpanel">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="msg-header">
                            <div class="pull-right">
                                Showing 1 - 10 of 100 reports
                                <button class="btn btn-white btn-navi btn-navi-left ml5" type="button"><i class="fa fa-chevron-left"></i></button>
                                <button class="btn btn-white btn-navi btn-navi-right" type="button"><i class="fa fa-chevron-right"></i></button>

                            </div>
                            <div class="pull-left">
                                <button class="btn btn-default btn-bordered" style="width:auto;"><i class="fa fa-send-o"></i> Notify Merchant</button>
                                <button class="btn btn-default btn-bordered" style="width:auto;"><i class="fa fa-trash"></i> Delete</button>
                            </div><!-- pull-right -->
                        </div><!-- msg-header -->

                        <ul class="media-list msg-list">
                        @foreach($blurb_reports as $br)
                            <li class="media">
                                <div class="ckbox ckbox-primary pull-left">
                                    <input type="checkbox" id="checkbox1">
                                    <label for="checkbox1"></label>
                                </div>
                                <div class="media-body">
                                    <div class="pull-right media-option">
                                        <small><i class="fa fa-clock-o"></i> {{$br['created_at']}}</small>
                                        <div class="btn-group">
                                            <i class="fa fa-send tooltips" data-toggle="tooltip" title="Not yet notify"></i>
                                        </div>
                                    </div>
                                    <p><strong><u><a href="#">{{$br['app_user']['first_name']}} {{$br['app_user']['last_name']}}</a></u></strong> has reported a <strong><u><a href="#">blurb</a></u></strong> from <strong><u><a href="#">Starbucks</a></u></strong>.<br><strong>Reason:</strong> I didn't know how to use</p>
                                </div>
                            </li>
                        @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('custom-js')
<script type="text/javascript">

</script>
@endsection
