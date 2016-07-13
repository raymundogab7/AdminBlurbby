@extends('layouts.admin')

@section('page-title', 'Merchang Tutorial' . ' Campaign Details')

@section('custom-css')

<link href="{{asset('css/toggles.css')}}" rel="stylesheet">
<link href="{{asset('css/bootstrap-wysihtml5.css')}}" rel="stylesheet" />

@endsection

@section('body-contents')

<section>
	<div class="mainwrapper">

		@include('layouts.sidebar-admin')
		<div class="mainpanel">
	        <div class="pageheader">
	            <div class="media">
	                <div class="pageicon pull-left">
	                    <i class="fa fa-pencil"></i>
	                </div>
	                <div class="media-body">
	                    <ul class="breadcrumb">
	                        <li><a href=""><i class="glyphicon glyphicon-home"></i></a></li>
	                        <li>Pages</li>
	                    </ul>
	                    <h4>Pages</h4>
	                </div>
	            </div><!-- media -->
	        </div><!-- pageheader -->
	    	<div class="contentpanel">
	            <div class="panel panel-default">
	                <div class="panel-body">
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
						<form class="form-horizontal form-bordered" style="padding-bottom:30px;">
							<div class="form-group">
								<label class="col-sm-1 control-label" style="text-align:left;">Page</label>
								<div class="col-sm-11">
									<select id="pagename" data-placeholder="Choose One" class="width300" required="" onchange="loadPage(this)">
										<optgroup label="Merchant Dashboard">
										<option value="1">Merchant Tutorial</option>
										<option value="2">FAQs</option>
										<option value="3">Terms & Conditions</option>
										<option value="4">Privacy Policy</option>
										<optgroup label="App Interface">
										<option value="5" selected="selected">App Tutorial</option>
										<option value="6">FAQs</option>
										<option value="7">Terms Of Use</option>
										<option value="8">Privacy Policy</option>
									</select>
								</div>
							</div><!-- form-group -->
						</form>
						<textarea id="ckeditor" placeholder="Enter text here..." class="form-control" rows="10">
							{{$page->page_content}}
						</textarea>
						<button style="margin-top:15px;" type="submit" class="btn btn-primary">Update</button>
	                </div>
	            </div><!-- panel -->

	        </div><!-- contentpanel -->
	    </div>
	</div><!-- mainwrapper -->
</section>
@endsection

@section('custom-js')

<script type="text/javascript" src="{{asset('js/wysihtml5-0.3.0.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap-wysihtml5.js')}}"></script>
<script type="text/javascript" src="{{asset('js/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript" src="{{asset('js/ckeditor/adapters/jquery.js')}}"></script>

<script type="text/javascript">
	jQuery(document).ready(function(){
      // CKEditor
      jQuery('#ckeditor').ckeditor();

    });

	jQuery('#pagename').select2({
        minimumResultsForSearch: -1
    });
</script>

@endsection
