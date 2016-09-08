@extends('layouts.admin')

@section('page-title', 'Featured Slide')

@section('custom-css')
<link href="{{asset('css/toggles.css')}}" rel="stylesheet">
<link href="{{asset('css/dropzone.css')}}" rel="stylesheet">
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
                        <div class="col-sm-12 col-md-4 col-xs-12" style="padding-bottom:30px;width:350px;;">
                            <div style="border: 1px solid #ccc;">
                                <img src="{{asset($featured_section->slide_image)}}" style="width: 100%;">
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

                        <div class="col-sm-12 col-md-7 col-xs-12">
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
                            <div class="col-sm-12" style="padding-bottom:30px;">
                                <div class="col-sm-8">
                                    <h4 class="md-title">Slide Image *</h4>
                                    {!! Form::open(array('id'=>'featured-update', 'files' => true, 'enctype' => 'multipart/form-data', 'url' => 'featured-section/updateImage/'.$slide_image_number, 'class' => 'single-dropzone dropzone', 'method'=>'POST')) !!}

                                        <div class="fallback">
                                            <input name="file" type="file" />
                                        </div>

                                    {!! Form::close() !!}
                                    <span class="help-block">Must be 2:1 ratio with at least 800px x 400px.</span>
                                </div>
                            </div>

                            <form id="featured-section-form" class="form-horizontal form-bordered" method="POST" action="{{url('featured-section/'.$featured_section->id)}}">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">Position *</label>
                                    <div class="col-sm-8">
                                        <input type="hidden" name="_method" value="PUT">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <select id="position" required="required" data-placeholder="Choose One" class="width300" name="position">
                                            <option value="" selected="">Choose One</option>
                                            @foreach($featured_sections as $fs)
                                            <option <?php if ($fs['position'] == $featured_section->position): ?> selected="selected" <?php endif;?> value="{{$fs['position']}}">Position {{$fs['position']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!-- form-group -->

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">Eatery Name *</label>
                                    <div class="col-sm-8">
                                        <select id="merchant" required="required" data-placeholder="Choose One" class="width300" name="merchant_id">
                                            <option value="">Choose One</option>
                                            @foreach($restaurants as $restaurant)
                                            <option value="{{$restaurant['merchant_id']}}" <?php if ($featured_section->merchant->id == $restaurant['merchant_id']): ?> selected="selected" <?php endif;?> >{{$restaurant['res_name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!-- form-group -->

                                <!-- <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">Slide Image *</label>
                                    <div class="col-sm-5">
                                        <input name="slide_image_temp" type="file" />
                                        <span class="help-block">Must be at least 800px x 400px.</span>
                                    </div>
                                </div> -->

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">Status *</label>
                                    <div class="col-sm-8">
                                        <select id="status" name="status" required="required" data-placeholder="Choose One" class="width300">
                                            <option value="">Choose One</option>
                                            <option <?php if ($featured_section->status == "Published"): ?> selected="selected" <?php endif;?> value="Published">Published</option>
                                            <option <?php if ($featured_section->status == "Unpublished"): ?> selected="selected" <?php endif;?> value="Unpublished">Unpublished</option>
                                        </select>
                                    </div>
                                </div><!-- form-group -->
                                <input name="featured_section_id" value="{{$featured_section->id}}" required="required" readonly="readonly" type="hidden" />
                                <br>
                                <button style="margin-left:15px;" type="submit" id="btn-featured-section-update" class="btn btn-primary">Update</button>
                                <a href="{{url('featured-section/'.$featured_section->id)}}">
                                    <button style="margin-left:15px;" class="btn btn-danger" type="button">Delete</button>
                                </a>
                            {!! Form::close() !!}

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

    Dropzone.options.featuredUpdate = {
        autoProcessQueue: false,
        init: function() {
            var myDropzone = this;
            $('#btn-featured-section-update').on("click", function(e) {
                myDropzone.processQueue();
                if(myDropzone.files.length != 0) {
                  e.preventDefault();
                  e.stopPropagation();
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
               $('#featured-section-form').submit();
            });

            this.on("error", function(file) {
                alert('Invalid format');
                myDropzone.removeFile(file);
            });
        }
    };
// Select2
    jQuery('#position, #merchant, #status').select2({
        minimumResultsForSearch: -1
    });
</script>


<script type="text/javascript" src="{{asset('js/toggles.min.js')}}"></script>
@endsection