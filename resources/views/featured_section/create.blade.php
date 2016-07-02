@extends('layouts.admin')

@section('page-title', 'Featured Slide')

@section('custom-css')
<link href="{{asset('css/toggles.css')}}" rel="stylesheet">
@endsection

@section('body-contents')
	<section>
        <div class="mainwrapper">
            @include('layouts.sidebar-admin')
    		<div class="mainpanel">
                <div class="pageheader">
                    <div class="media">
                        <div class="pageicon pull-left">
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="media-body">
                            <ul class="breadcrumb">
                                <li><a href="{{url('dashboard')}}"><i class="glyphicon glyphicon-home"></i></a></li>
                                <li><a href="{{url('featured-slide')}}">Featured Section</a></li>
                                <li>Featured Slide</li>
                            </ul>
                            <h4>Featured Slide</h4>
                        </div>
                    </div><!-- media -->
                </div><!-- pageheader -->
                <div class="contentpanel">
                    <div class="row">
                        {!! Form::open(array('url' => 'featured-section', 'class' => 'form-horizontal form-bordered', 'files' => true, 'enctype' => 'multipart/form-data')) !!}
                            <div class="form-group">
                                <label class="col-sm-2 control-label" style="text-align:left;">Position *</label>
                                <div class="col-sm-8">
                                    
                                    <select id="position" required="required" data-placeholder="Choose One" class="width300" name="position">
                                        <option value="">Choose One</option>
                                        <option value="1" selected="selected">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                            </div><!-- form-group -->
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label" style="text-align:left;">Merchant Name *</label>
                                <div class="col-sm-8">
                                    <select id="merchant" required="required" data-placeholder="Choose One" class="width300" name="merchant_id">
                                        <option value="">Choose One</option>
                                        @foreach($merchant as $m)
                                        <option value="{{$m['id']}}">{{$m['coy_name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div><!-- form-group -->
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label" style="text-align:left;">Slide Image *</label>
                                <div class="col-sm-5">
                                    <input name="slide_image" required="required" type="file" />
                                    <span class="help-block">Must be at least 800px x 400px.</span>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label" style="text-align:left;">Status *</label>
                                <div class="col-sm-8">
                                    <select id="status" name="status" required="required" data-placeholder="Choose One" class="width300">
                                        <option value="">Choose One</option>
                                        <option value="Published">Published</option>
                                        <option value="Unpublished" selected="selected">Unpublished</option>
                                    </select>
                                </div>
                            </div><!-- form-group -->
                            <br>
                            <button style="margin-left:15px;" class="btn btn-primary">Update</button>
                            <button style="margin-left:15px;" class="btn btn-danger">Delete</button>
                        {!! Form::close() !!}
                    </div><!-- row -->  
                
                </div><!-- contentpanel -->
            </div><!-- mainpanel -->
        </div><!-- mainwrapper -->
    </section>
@endsection

@section('custom-js')
<script>
    
    // Select2
    jQuery('#position, #merchant, #status').select2({
        minimumResultsForSearch: -1
    });
</script>
<script type="text/javascript" src="{{asset('js/toggles.min.js')}}"></script>
@endsection