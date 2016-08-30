                            <form method="POST" action="{{url('blurb/'.$blurb->id)}}" accept-charset="UTF-8" class="form-horizontal form-bordered">
                           <!--  {!! Form::open(array('url' => 'blurb/'.$blurb->id, 'class' => 'form-horizontal form-bordered', 'method' => 'PUT')) !!} -->


                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">Blurb Title *</label>
                                    <div class="col-sm-8">
                                    <input type="hidden" value="{{csrf_token()}}" name="_token">
                                    <input type="hidden" name="_method" value="PUT">
                                        {!! Form::hidden('campaign_id', $campaign->id, ['required' => 'required', 'class' => 'form-control', 'readonly' => 'readonly']) !!}
                                        {!! Form::hidden('blurb_id', $blurb->id, ['required' => 'required', 'class' => 'form-control', 'readonly' => 'readonly']) !!}
                                        {!! Form::hidden('control_no', $campaign->control_no, ['required' => 'required', 'class' => 'form-control', 'readonly' => 'readonly']) !!}
                                        {!! Form::text('blurb_name', $blurb->blurb_name, ['required' => 'required', 'class' => 'form-control']) !!}
                                    </div>
                                </div><!-- form-group -->

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">Category *</label>
                                    <div class="col-sm-8">
                                        <select name="blurb_category_id" id="select-search-hide" data-placeholder="Choose One" class="width300" required />
                                            <option value="">Choose One</option>
                                            @foreach($blurb_category as $bc)
                                            <option value="{{$bc['id']}}" <?php if ($bc['id'] == $blurb->category->id): ?> selected <?php endif;?>>{{$bc['blurb_cat_name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!-- form-group -->

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">Start Date *</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            {!! Form::text('blurb_start', (is_null($blurb->blurb_start)) ? '' : date_format(date_create($blurb->blurb_start), 'd-M-Y'), ['required' => 'required', 'id' => 'datepicker', 'placeholder' => 'DD-MMM-YYYY', 'class' => 'form-control']) !!}
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                        </div><!-- input-group -->
                                    </div>
                                </div><!-- form-group -->

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">End Date *</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            {!! Form::text('blurb_end', (is_null($blurb->blurb_end)) ? '' : date_format(date_create($blurb->blurb_end), 'd-M-Y'), ['required' => 'required' ,'id' => 'datepicker2', 'placeholder' => 'DD-MMM-YYYY', 'class' => 'form-control']) !!}
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
                                        <select id="select_status" name="blurb_status" data-placeholder="Choose One" style="width:100%;" tabindex="-1" title="" class="select2-offscreen">
                                            <option value="{{$blurb->blurb_status}}">Choose One</option>
                                            <option value="Created" <?php if ($blurb->blurb_status == "Created"): ?> selected="selected" <?php endif;?>>Created</option>
                                            <option value="Pending Admin Approval" <?php if ($blurb->blurb_status == "Pending Admin Approval"): ?> selected="selected" <?php endif;?>>Pending Admin Approval</option>
                                            <option value="Approved" <?php if ($blurb->blurb_status == "Approved"): ?> selected="selected" <?php endif;?>>Approved</option>
                                            <option value="Rejected" <?php if ($blurb->blurb_status == "Rejected"): ?> selected="selected" <?php endif;?>>Rejected</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">Reason</label>
                                    <div class="col-sm-8">
                                        {!! Form::textarea('blurb_rej_reason', $blurb->blurb_rej_reason, ['class' => 'form-control', 'maxlength' => 2000]) !!}
                                    </div>
                                </div><!-- form-group -->
                                <br>
                                <button style="margin-left:15px;" type="submit" class="btn btn-primary">Update</button>
                                <a href="{{url('campaigns/'.$campaign->id)}}"><button type="button" style="margin-left:15px;" class="btn btn-default">Back</button></a>
                            <!-- {!! Form::close() !!} -->
                            </form>
