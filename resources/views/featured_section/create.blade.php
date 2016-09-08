@extends('layouts.admin')

@section('page-title', 'Featured Slide')

@section('custom-css')
<link href="{{asset('css/toggles.css')}}" rel="stylesheet">
<link href="{{asset('css/dropzone.css')}}" rel="stylesheet">
<style type="text/css">
#loading {
   width: 100%;
   height: 100%;
   top: 0;
   left: 0;
   position: fixed;
   display: block;
   opacity: 0.7;
   background-color: #000;
   z-index: 99;
   text-align: center;
   vertical-align: top;
}

#loading-image {
    position: relative;
    top: 50%;
    transform: translate(0%, -50%);
    z-index: 100;
    margin: 0;
}

.caption {
    /* Make the caption a block so it occupies its own line. */
    color: #fff;
    display: block;
}
</style>
@endsection

@section('body-contents')
<div id="loading">
  <img id="loading-image" src="{{asset('images/loaders/loadingIcon.GIF')}}" style="width:150px;" alt="Loading..." />
  <span class="caption"><b style="font-size:20px;">Preparing image...</b></span>
</div>
	<section>
        <div class="mainwrapper">
            @include('layouts.sidebar-admin')
    		<div class="mainpanel">
                <div class="pageheader">
                    <div class="media">
                        <div class="pageicon pull-left">
                            <i class="fa fa-plus-square"></i>
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
                        <div class="col-sm-12 col-md-4 col-xs-12" style="padding-bottom:30px;width:350px;">
                            <div style="border: 1px solid #ccc;">
                                <img src="{{asset('images/featured-placeholder.jpg')}}" style="width: 100%;">
                                <div style="padding:10px 15px 15px 15px;">
                                    <span style="float:left;">Popular Blurbs</span><span style="float:right;">See All ></span>
                                </div>
                                <div class="mb10"></div>
                                <div style="padding-left: 15px;">
                                    <img src="{{asset('images/box-featured-section-placeholder.jpg')}}" style="width:75px;padding-right:10px;"><img src="{{asset('images/box-featured-section-placeholder.jpg')}}" style="width:75px;padding-right:10px;"><img src="{{asset('images/box-featured-section-placeholder.jpg')}}" style="width:75px;padding-right:10px;"><img src="{{asset('images/box-featured-section-placeholder.jpg')}}" style="width:75px;padding-right:10px;">
                                </div>
                                <div class="mb10"></div>
                                <div style="padding:5px 15px;border-top:1px solid #ddd;background-color:#f5f5f5;">
                                    <span style="color:#888888;font-size:12px;">TOP BLURBS BY CUISINE</span>
                                </div>

                                <div style="padding:12px 15px;border-top:1px solid #ddd;">
                                    <span style="font-size:12px;">CUISINE</span>
                                </div>
                                <div style="padding:12px 15px;border-top:1px solid #ddd;">
                                    <span style="font-size:12px;">CUISINE</span>
                                </div>
                                <div style="padding:12px 15px;border-top:1px solid #ddd;">
                                    <span style="font-size:12px;">CUISINE</span>
                                </div>
                                <div style="padding:12px 15px;border-top:1px solid #ddd;">
                                    <span style="font-size:12px;">CUISINE</span>
                                </div>
                                <div style="padding:12px 15px;border-top:1px solid #ddd;">
                                    <span style="font-size:12px;">CUISINE</span>
                                </div>
                                <div style="padding:12px 15px;border-top:1px solid #ddd;">
                                    <span style="font-size:12px;">CUISINE</span>
                                </div>
                            </div>
                        </div><!-- col-sm-4 col-md-3 -->
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
                        <div class="col-sm-12 col-md-7 col-xs-12">
                            <div class="col-sm-12" style="padding-bottom:30px;">
                                <div class="col-sm-8">
                                    <h4 class="md-title">Slide Image *</h4>
                                    {!! Form::open(array('id'=>'featured-photo', 'files' => true, 'enctype' => 'multipart/form-data', 'url' => 'featured-section/uploadImage', 'class' => 'single-dropzone dropzone', 'method'=>'POST')) !!}

                                        <div class="fallback">
                                            <input name="file" type="file" />
                                        </div>

                                    {!! Form::close() !!}
                                    <span class="help-block">Must be 2:1 ratio with at least 800px x 400px.</span>
                                </div>
                            </div>
                            <form method="POST" id="featured-section-form" action="{{url('featured-section')}}" class="form-horizontal form-bordered" files="true" enctype="multipart/form-data">
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

                              <!--   <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">Slide Image *</label>
                                    <div class="col-sm-5">
                                        <input name="slide_image_temp" required="required" type="file" />
                                        <span class="help-block">Must be at least 800px x 400px.</span>
                                    </div>
                                </div> -->

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
                                <button style="margin-left:15px;" type="submit" id="btn-create-featured-section" class="btn btn-primary">Create</button>
                                <a href="{{url('featured-section')}}"><button type="button" style="margin-left:15px;" class="btn btn-default">Back</button></a>
                            </form>
                        </div>
                    </div><!-- row -->
                </div><!-- contentpanel -->
            </div><!-- mainpanel -->
        </div><!-- mainwrapper -->
    </section>
@endsection

@section('custom-js')
<script type="text/javascript" src="{{asset('js/dropzone.min.js')}}"></script>
<script>
    // Select2
    jQuery('#position, #merchant, #status').select2({
        minimumResultsForSearch: -1
    });
    jQuery('#loading').hide();
    Dropzone.options.featuredPhoto = {
        //autoProcessQueue: false,
        init: function() {
            var myDropzone = this;

            $('#btn-create-featured-section').on("click", function(e) {
                if(myDropzone.files.length == 0) {
                    alert('Slide Image is required.');

                }
                else {
                    myDropzone.processQueue();
                }
            });

            this.on("thumbnail", function(file){

            if (file.height < 800 && file.width < 400) {
                    alert("Image should be at least 800px x 400px");
                    myDropzone.removeFile(file);
                    return false;
                }
            });

            this.on("success", function(file) {

            });

            this.on("sending", function(file) {
                jQuery('#loading').fadeIn();
            });

            this.on("error", function(file) {
                jQuery('#loading').fadeOut();
                alert('Invalid format');
                myDropzone.removeFile(file);
            });

            this.on("complete", function(file) {
                jQuery('#loading').fadeOut();
            });

        }
    };


</script>
<script type="text/javascript" src="{{asset('js/toggles.min.js')}}"></script>
@endsection
