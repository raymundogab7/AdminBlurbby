
                            <form class="form-horizontal form-bordered">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">Blurb Title *</label>
                                    <div class="col-sm-8">
                                        <input type="text" value="{{$blurb->blurb_name}}" class="form-control" required id="disabledinput" disabled="" />
                                    </div>
                                </div><!-- form-group -->

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">Category *</label>
                                    <div class="col-sm-8">
                                        <select  name="blurb_category_id" id="select-search-hide" data-placeholder="Choose One" class="width300" required id="disabledinput" disabled="" />
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
                                            <input type="text" class="form-control" value="{{date_format(date_create($blurb->blurb_start), 'd-M-Y')}}" placeholder="DD-MMM-YYYY" id="datepicker" required id="disabledinput" disabled="" />
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                        </div><!-- input-group -->
                                    </div>
                                </div><!-- form-group -->

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">End Date *</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="{{date_format(date_create($blurb->blurb_end), 'd-M-Y')}}" placeholder="DD-MMM-YYYY" id="datepicker2" required id="disabledinput" disabled="" />
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                        </div><!-- input-group -->
                                    </div>
                                </div><!-- form-group -->

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">Description *</label>
                                    <div class="col-sm-8">
                                        <textarea rows="5" class="form-control" maxlength="500" required id="disabledinput" disabled="" />{{$blurb->blurb_desc}}</textarea>
                                    </div>
                                </div><!-- form-group -->

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">Terms & Conditions *</label>
                                    <div class="col-sm-8">
                                        <textarea rows="5" class="form-control" maxlength="2000" id="disabledinput" disabled="" />{{$blurb->blurb_terms}}</textarea>
                                    </div>
                                </div><!-- form-group -->

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">Status</label>
                                    <div class="col-sm-8">
                                        @if($blurb['blurb_status'] == 'Approved')
                                        <label class="control-label text-success" style="text-align:left;font-weight:bold;">
                                        @elseif($blurb['blurb_status'] == 'Checked')
                                        <label class="control-label text-success" style="text-align:left;font-weight:bold;">
                                        @elseif($blurb['blurb_status'] == 'Live')
                                        <label class="control-label text-success" style="text-align:left;font-weight:bold;">
                                        @else
                                        <label class="control-label text-warning" style="text-align:left;font-weight:bold;">
                                        @endif
                                        {{$blurb->blurb_status}}
                                        </label>
                                    </div>
                                </div><!-- form-group -->

                                <br>
                                <a href="{{url('campaigns/'.$campaign->id)}}"><button type="button" style="margin-left:15px;" class="btn btn-default">Back</button></a>
                            </form>

