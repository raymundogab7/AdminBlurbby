@extends('layouts.admin')

@section('page-title', 'Merchant Tutorial' . ' Campaign Details')

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
						<form action="{{url('pages/'.$page->id)}}" method="POST" class="form-horizontal form-bordered" style="padding-bottom:30px;">
							<div class="form-group">
								<label class="col-sm-1 control-label" style="text-align:left;">Page</label>
								<div class="col-sm-11">
									<input type="hidden" readonly="readonly" value="PUT" name="_method">
									<input type="hidden" readonly="readonly" value="{{csrf_token()}}" name="_token">
									<input type="hidden" readonly="readonly" value="{{\Auth::user()->id}}" name="modified_by">
									<select id="pagename" data-placeholder="Choose One" class="width300" required="" onchange="loadPage(this)">
										<optgroup label="Merchant Dashboard">
										<option <?php if ($page->id == 1): ?> selected="selected" <?php endif;?>" value="1">Merchant Tutorial</option>
										<option <?php if ($page->id == 2): ?> selected="selected" <?php endif;?>" value="2">FAQs</option>
										<option <?php if ($page->id == 3): ?> selected="selected" <?php endif;?>" value="3">Terms & Conditions</option>
										<option <?php if ($page->id == 4): ?> selected="selected" <?php endif;?>" value="4">Privacy Policy</option>
										<optgroup label="App Interface">
										<option <?php if ($page->id == 5): ?> selected="selected" <?php endif;?>" value="5">App Tutorial</option>
										<option <?php if ($page->id == 6): ?> selected="selected" <?php endif;?>" value="6">FAQs</option>
										<option <?php if ($page->id == 7): ?> selected="selected" <?php endif;?>" value="7">Terms Of Use</option>
										<option <?php if ($page->id == 8): ?> selected="selected" <?php endif;?>" value="8">Privacy Policy</option>
									</select>
								</div>
							</div><!-- form-group -->
							<textarea id="ckeditor" name="page_content" placeholder="Enter text here..." class="form-control" rows="10">
								{{$page->page_content}}
							</textarea>
							<button style="margin-top:15px;" type="submit" class="btn btn-primary">Update</button>
						</form>
	                </div>
	            </div><!-- panel -->

	        </div><!-- contentpanel -->
	    </div>
	</div><!-- mainwrapper -->
</section>
<input type="text" disabled="" value="{{url('')}}" id="url">
@endsection

@section('custom-js')

<script type="text/javascript" src="{{asset('js/wysihtml5-0.3.0.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap-wysihtml5.js')}}"></script>
<script type="text/javascript" src="{{asset('js/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript" src="{{asset('js/ckeditor/plugins/uploadimage/plugin.js')}}"></script>
<script type="text/javascript" src="{{asset('js/ckeditor/adapters/jquery.js')}}"></script>

<script type="text/javascript">
	function loadPage(page)
	{
		window.location.href=$('#url').val() + '/pages/' + page.value + '/edit';
	}

	jQuery(document).ready(function(){
      // CKEditor
      jQuery('#ckeditor').ckeditor({
			height: 300,

			// Configure your file manager integration. This example uses CKFinder 3 for PHP.
			filebrowserBrowseUrl: 'http://blurbby.admin.loc/static_image?command=QuickUpload&type=Images',
			filebrowserImageBrowseUrl: 'http://blurbby.admin.loc/static_image?command=QuickUpload&type=Images',
			filebrowserUploadUrl: 'http://blurbby.admin.loc/static_image/upload?command=QuickUpload&type=Images',
			filebrowserImageUploadUrl: 'http://blurbby.admin.loc/static_image/upload?command=QuickUpload&type=Images'
		});


    });

	jQuery('#pagename').select2({
        minimumResultsForSearch: -1
    });


</script>
<script>

	</script>
@endsection
