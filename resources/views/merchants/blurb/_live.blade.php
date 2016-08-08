
 
                            {!! Form::open(array('url' => 'blurb/report/generate/'.$blurb->id, 'style' => 'display:inline;', 'class' => 'form-horizontal form-bordered')) !!}
                                <input type="hidden" name="blurb_status" value="Live" readonly="">
                                <input type="hidden" name="campaign_id" value="{{$campaign->id}}" readonly="">
                                <button class="btn btn-info" style="margin-left:15px;"><i class="fa fa-file-excel-o"></i>&nbsp;
                                    Download Analytics Report (.csv)
                                </button>
                            {!! Form::close() !!}
                                <hr>
                            <div class="col-md-4">
                                <div class="panel panel-default">
                                    <div class="panel-body padding15">
                                        <h5 class="md-title mt0 mb10">Blurb's Likes</h5>
                                        <div id="basicflot" class="flotChart"></div>
                                    </div><!-- panel-body -->
                                </div><!-- panel -->
                            </div>
                            <div class="col-md-4">
                                <div class="panel panel-default">
                                    <div class="panel-body padding15">
                                        <h5 class="md-title mt0 mb10">Blurb's Views</h5>
                                        <div id="basicflot2" class="flotChart"></div>
                                    </div><!-- panel-body -->
                                </div><!-- panel -->
                            </div>
                            
                            <div class="col-md-4">
                                <div class="panel panel-default">
                                    <div class="panel-body padding15">
                                        <h5 class="md-title mt0 mb10">Blurb's Usage</h5>
                                        <div id="basicflot3" class="flotChart"></div>
                                    </div><!-- panel-body -->
                                </div><!-- panel -->
                            </div>
                        
                            <input type="hidden" id="blurb_id" disabled="" value="{{$blurb->id}}">
    @section('custom-js')

    <script type="text/javascript" src="{{asset('js/flot/jquery.flot.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/flot/jquery.flot.resize.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/flot/jquery.flot.spline.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/raphael-2.1.0.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap-wizard.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/blurb_charts.js')}}"></script>


    @endsection        