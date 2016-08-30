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
                                <li><a href="{{url('featured-section')}}">Featured Section</a></li>
                                <li>Featured Slide</li>
                            </ul>
                            <h4>Featured Slide</h4>
                        </div>
                    </div><!-- media -->
                </div><!-- pageheader -->
                <div class="contentpanel">
                    <div class="row">
                        @if(session('message'))

                        <div class="alert alert-success">
                            <strong>{{session('message')}}</strong>
                        </div>

                        @endif

                        @if(session('error'))

                        <div class="alert alert-danger">
                           <strong>{{session('error')}}</strong>
                        </div>

                        @endif
                        <!-- {!! Form::open(array('url' => 'featured-section', 'class' => 'form-horizontal form-bordered', 'files' => true, 'enctype' => 'multipart/form-data')) !!} -->
                        <form method="POST" action="{{url('featured-section')}}" class="form-horizontal form-bordered" files="true" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="col-sm-2 control-label" style="text-align:left;">Position *</label>
                                <div class="col-sm-8">
                                    @if($slides_count > 0)
                                    <select id="position" required="required" data-placeholder="Choose One" class="width300" name="position">
                                        <option value="" selected="">Choose One</option>
                                        @for($i=1;$i<=$slides_count;$i++)
                                        <option value="{{$i}}">Position {{$i}}</option>
                                        @endfor
                                    </select>
                                    @else
                                    <select id="position" required="required" data-placeholder="Choose One" class="width300" name="position">
                                        <option value="" selected="">Choose One</option>
                                        <option value="1">Position 1</option>

                                    </select>
                                    @endif
                                </div>
                            </div><!-- form-group -->

                            <div class="form-group">
                                <label class="col-sm-2 control-label" style="text-align:left;">Eatery Name *</label>
                                <div class="col-sm-8">
                                    <select id="merchant" required="required" data-placeholder="Choose One" class="width300" name="merchant_id">
                                        <option value="">Choose One</option>
                                        @foreach($restaurants as $restaurant)
                                        <option value="{{$restaurant['merchant_id']}}">{{$restaurant['res_name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div><!-- form-group -->

                            <div class="form-group">
                                <label class="col-sm-2 control-label" style="text-align:left;">Slide Image *</label>
                                <div class="col-sm-5">
                                    <input name="slide_image_temp" required="required" type="file" />
                                    <span class="help-block">Must be at least 800px x 400px.</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" style="text-align:left;">Status *</label>
                                <div class="col-sm-8">
                                    <select id="status" name="status" required="required" data-placeholder="Choose One" class="width300">
                                        <option value="" selected="selected">Choose One</option>
                                        <option value="Published">Published</option>
                                        <option value="Unpublished">Unpublished</option>
                                    </select>
                                </div>
                            </div><!-- form-group -->
                            <br>
                            <button style="margin-left:15px;" class="btn btn-primary">Create</button>
                            <a href="{{url('featured-section')}}"><button type="button" style="margin-left:15px;" class="btn btn-default">Back</button></a>
                        </form>
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
