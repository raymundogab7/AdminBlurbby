
                            <form method="POST" action="{{url('blurb/'.$blurb->id)}}" accept-charset="UTF-8" class="form-horizontal form-bordered">
                           <!--  {!! Form::open(array('url' => 'blurb/'.$blurb->id, 'class' => 'form-horizontal form-bordered', 'method' => 'PUT')) !!} -->
                                <input type="hidden" value="{{csrf_token()}}" name="_token">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">Blurb Title *</label>
                                    <div class="col-sm-8">
                                        <input type="hidden" name="_method" value="PUT">
                                        {!! Form::hidden('campaign_id', $campaign->id, ['required' => 'required', 'class' => 'form-control', 'readonly' => 'readonly']) !!}
                                        {!! Form::hidden('control_no', $campaign->control_no, ['required' => 'required', 'class' => 'form-control', 'readonly' => 'readonly']) !!}
                                        {!! Form::text('blurb_name', $blurb->blurb_name, ['required' => 'required', 'class' => 'form-control']) !!}
                                    </div>
                                </div><!-- form-group -->
                                
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">Category *</label>
                                    <div class="col-sm-8">
                                        <select id="select-search-hide" data-placeholder="Choose One" class="width300" required name="blurb_category" />
                                            <option value="Discount" <?php if($blurb->blurb_category == 'Discount') : ?> selected <?php endif; ?>>Discount</option>
                                            <option value="Freebies" <?php if($blurb->blurb_category == 'Freebies') : ?> selected <?php endif; ?>>Freebies</option>
                                        </select>
                                    </div>
                                </div><!-- form-group -->
                                
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">Start Date *</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            {!! Form::text('blurb_start', date_format(date_create($blurb->blurb_start), 'd-M-Y'), ['required' => 'required', 'id' => 'datepicker', 'placeholder' => 'YYYY-MM-DD', 'class' => 'form-control']) !!}
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                        </div><!-- input-group -->
                                    </div>
                                </div><!-- form-group -->
                                
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">End Date *</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            {!! Form::text('blurb_end', date_format(date_create($blurb->blurb_end), 'd-M-Y'), ['required' => 'required' ,'id' => 'datepicker2', 'placeholder' => 'YYYY-MM-DD', 'class' => 'form-control']) !!}
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                        </div><!-- input-group -->
                                    </div>
                                </div><!-- form-group -->
                                
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">Description *</label>
                                    <div class="col-sm-8">
                                        {!! Form::textarea('blurb_desc', $blurb->blurb_desc, ['required' => 'required', 'class' => 'form-control', 'maxlength' => 500]) !!}
                                    </div>
                                </div><!-- form-group -->
                                
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">Terms & Conditions *</label>
                                    <div class="col-sm-8">
                                        {!! Form::textarea('blurb_terms', $blurb->blurb_terms, ['required' => 'required', 'class' => 'form-control', 'maxlength' => 2000]) !!}
                                    </div>
                                </div><!-- form-group -->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">Status</label>
                                    <div class="col-sm-8">
                                        <label class="text-danger control-label" style="text-align:left;"><strong>{{$blurb->blurb_status}}</strong></label>
                                    </div>
                                </div><!-- form-group -->
                                <br>
                                <button style="margin-left:15px;" type="submit" class="btn btn-primary">Update</button>
                                <a href="{{url('campaigns/'.$campaign->id)}}"><button type="button" style="margin-left:15px;" class="btn btn-default">Back</button></a>
                            <!-- {!! Form::close() !!} -->
                            </form>

           