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
                                <?php
$notif_total = $blurb_reports->total();
$notif_count = $blurb_reports->count() - 1;

?>
                                @if($blurb_reports->total() > 0)
                                Showing {{$blurb_reports->firstItem()}} - {{$blurb_reports->lastItem()}} of {{$blurb_reports->total()}} reports
                                @else
                                Showing 0 - 0 of {{$blurb_reports->total()}} reports
                                @endif
                                @if(array_key_exists('page', $_GET))
                                <a href="{{ $blurb_reports->url($_GET['page'] - 1) }}"><button class="btn btn-white btn-navi btn-navi-left ml5" type="button"><i class="fa fa-chevron-left"></i></button></a>
                                <a href="<?php echo ($blurb_reports->currentPage() != $blurb_reports->lastPage() && $blurb_reports->total() > 0) ? $blurb_reports->nextPageUrl() : '#'; ?>" style="<?php echo ($blurb_reports->currentPage() != $blurb_reports->lastPage() && $blurb_reports->total() > 0) ? '' : 'cursor:default'; ?>"><button <?php echo ($blurb_reports->currentPage() != $blurb_reports->lastPage() && $blurb_reports->total() > 0) ? '' : 'disabled'; ?> class="btn btn-white btn-navi btn-navi-right" type="button"><i class="fa fa-chevron-right"></i></button></a>
                                @else
                                <button class="btn btn-white btn-navi btn-navi-left ml5" type="button"><i class="fa fa-chevron-left" disabled></i></button>
                                <a href="{{ $blurb_reports->url(2) }}"><button class="btn btn-white btn-navi btn-navi-right" type="button"><i class="fa fa-chevron-right"></i></button></a>
                                @endif

                            </div>
                            <div class="pull-left">
                                <button <?php if (count($blurb_reports) == 0): ?> disabled <?php endif;?> class="btn btn-default btn-bordered btn_report" id="btn-notify" style="width:auto;"><i class="fa fa-send-o"></i> <span id="notify_merchant">Notify Merchant</span></button>
                                <button <?php if (count($blurb_reports) == 0): ?> disabled <?php endif;?> class="btn btn-default btn-bordered btn_report" id="btn-delete-blurb-reports" style="width:auto;"><i class="fa fa-trash"></i> <span id="delete_merchant">Delete</span></button>
                            </div><!-- pull-right -->
                        </div><!-- msg-header -->
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
                        <ul class="media-list msg-list">
                        @foreach($blurb_reports as $br)

                            <li class="media">
                                <div class="ckbox ckbox-primary pull-left">
                                    <input type="checkbox" id="checkbox_{{$br['id']}}" class="checkbox" value="{{$br['id']}}">
                                    <label for="checkbox_{{$br['id']}}"></label>
                                </div>
                                <div class="media-body">
                                    <div class="pull-right media-option">


                                        <small><i class="fa fa-clock-o"></i> <?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($br['created_at']))->diffForHumans(); ?></small>
                                        <div class="btn-group">
                                            <i class="fa fa-send tooltips" data-toggle="tooltip" title="Not yet notify"></i>
                                        </div>
                                    </div>
                                    <p><strong><u><a href="{{url('app-users/'.$br['appUser']['id'].'/edit')}}">{{$br['appUser']['first_name']}} {{$br['appUser']['last_name']}}</a></u></strong> has reported a <strong><u><a href="{{url('blurb/'.$br['blurb']['id'].'/'.$br['campaign']['control_no'])}}">blurb</a></u></strong> from <strong><u><a href="{{url('merchants/'.$br['merchant']['id'].'/edit')}}">{{$br['restaurant']['res_name']}}</a></u></strong>.<br><strong>Reason:</strong> {{$br['reason']}}<br><strong>Comment:</strong> {{$br['comment']}}</p>
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
<!-- DELETE BLURB CATEGORY MODAL -->
<div class="modal fade errorBlurbReportModal" id="errorBlurbReportModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Error</h4>
      </div>
      <div class="modal-body">
        Error while deleting. Please try again.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<input type="hidden" disabled="" id="_token" value="{{csrf_token()}}">
@endsection
@section('custom-js')
<script type="text/javascript">
$('#btn-delete-blurb-reports').on('click', function(){
    $('input.checkbox:checkbox:checked').each(function () {
        $('.btn_report').attr('disabled', 'disabled');
        $('#delete_merchant').html('Deleting...');
        var blurb_report_id = $(this).val();
        $.ajax({
            data: {'_token' : $('#_token').val()},
            url : '/blurb-reports/' + blurb_report_id,
            method: 'DELETE',
            complete: function(data){
                if(!data.result) {
                    window.location.reload();
                }
            }
        });
    });
});

$('#btn-notify').on('click', function(){

    $('input.checkbox:checkbox:checked').each(function () {
        $('.btn_report').attr('disabled', 'disabled');
        $('#notify_merchant').html('Sending...');
        var blurb_report_id = $(this).val();
        $.ajax({
            data: {'_token' : $('#_token').val()},
            url : '/blurb-reports/notify/' + blurb_report_id,
            method: 'GET',
            complete: function(data){

                window.location.reload();
            }
        });
    });
});

</script>
@endsection
