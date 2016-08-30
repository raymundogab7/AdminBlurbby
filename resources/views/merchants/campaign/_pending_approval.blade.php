<div class="col-sm-12 col-md-8 col-xs-12" style="padding-bottom:20px;">
    <form class="form-horizontal form-bordered" style="display:inline;">
        <div class="form-group">
            <label class="col-sm-2 control-label" style="text-align:left;">Campaign Name *</label>
            <div class="col-sm-8">
                <input type="text" value="{{$campaign->campaign_name}}" class="form-control" id="disabledinput" disabled="" />
            </div>
        </div><!-- form-group -->

        <div class="form-group">
            <label class="col-sm-2 control-label" style="text-align:left;">Timezone *</label>
            <div class="col-sm-8">
                <input type="text" value="GMT +08:00 (Singapore)" id="disabledinput" class="form-control" disabled="" />
            </div>
        </div><!-- form-group -->

        <div class="form-group">
            <label class="col-sm-2 control-label" style="text-align:left;">Start Date *</label>
            <div class="col-sm-8">
                <div class="input-group">
                    <input type="text" class="form-control" value="{{date_format(date_create($campaign['cam_start']), 'd-M-Y')}}"" placeholder="DD-MMM-YYYY" id="disabledinput" disabled="">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                </div><!-- input-group -->
            </div>
        </div><!-- form-group -->

        <div class="form-group">
            <label class="col-sm-2 control-label" style="text-align:left;">End Date *</label>
            <div class="col-sm-8">
                <div class="input-group">
                    <input type="text" class="form-control" value="{{date_format(date_create($campaign['cam_end']), 'd-M-Y')}}" placeholder="DD-MMM-YYYY" id="disabledinput" disabled="">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                </div><!-- input-group -->
            </div>
        </div><!-- form-group -->

        <div class="form-group">
            <label class="col-sm-2 control-label" style="text-align:left;">Status</label>
            <div class="col-sm-8">
                <label class="text-warning control-label" style="text-align:left;"><strong>{{$campaign->cam_status}}</strong></label>
            </div>
        </div><!-- form-group -->
    </form>

    {!! Form::open(array('url' => 'campaigns/updateStatus/'.$campaign['id'], 'style' => 'display:inline;', 'class' => 'form-horizontal form-bordered', 'method' => 'PUT')) !!}
    <input type="hidden" name="cam_status" value="Draft">
    <button class="btn btn-danger">Withdraw Campaign</button>
    {!! Form::close() !!}
    <a href="{{url('merchants/'.$campaign->merchant_id.'/edit')}}">
        <button style="margin-left:15px;" class="btn btn-default">Back</button>
    </a>
</div>

<div class="col-sm-12 col-md-12 col-xs-12" style="padding-bottom:50px;">
     <hr>
    <h4 class="md-title">Blurbs</h4>
    <table id="pendingBlurbTable" class="table table-striped table-bordered responsive">
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
                <td><img src="{{asset($blurb['blurb_logo'])}}" style="width:20px"></td>
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
                    @elseif($blurb['blurb_status'] == 'Rejected')
                    <span class="text-danger">
                    @else
                    <span class="text-warning">
                    @endif
                    <strong>{{$blurb['blurb_status']}}</strong>
                    </span>
                </td>
                <td>{{$blurb['category']['blurb_cat_name']}}</td>
                <td>{{(is_null($blurb['blurb_start'])) ? '' : date_format(date_create($blurb['blurb_start']), 'd-M-Y')}}</td>
                <td>{{(is_null($blurb['blurb_end'])) ? '' : date_format(date_create($blurb['blurb_end']), 'd-M-Y')}}</td>
                <td class="table-action">
                    <a href="{{url('merchants/'.$blurb['id'].'/'.$campaign['control_no'].'/edit-blurb')}}" data-toggle="tooltip" title="View" class="tooltips"><i class="fa fa-eye"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@section('custom-js')
<script>
    jQuery(document).ready(function(){

        jQuery('#pendingBlurbTable').DataTable({
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
