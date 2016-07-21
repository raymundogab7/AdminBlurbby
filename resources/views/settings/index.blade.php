@extends('layouts.admin')

@section('page-title', 'Settings')

@section('custom-css')

<link href="{{asset('css/dropzone.css')}}" rel="stylesheet">
<link href="{{asset('css/bootstrap-timepicker.min.css')}}" rel="stylesheet">
<style type="text/css">
	.single-dropzone {

	}
  	.dz-image-preview, .dz-file-preview {
	    display: none;
  	}
</style>
@endsection

@section('body-contents')

<section>
    <div class="mainwrapper">

        @include('layouts.sidebar-admin')

        <div class="mainpanel">
            <div class="pageheader">
                <div class="media">
                    <div class="pageicon pull-left">
                        <i class="fa fa-gear"></i>
                    </div>
                    <div class="media-body">
                        <ul class="breadcrumb">
                            <li><a href="{{url('dashboard')}}"><i class="glyphicon glyphicon-home"></i></a></li>
                            <li>Settings</li>
                        </ul>
                        <h4>Settings</h4>
                    </div>
                </div><!-- media -->
            </div><!-- pageheader -->
            <div class="contentpanel">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-xs-12" style="padding-bottom:20px;">
                        <h3 style="font-weight:bold">Cuisine</h3>
                    </div>
                    <div class="col-sm-6 col-md-6 col-xs-12" style="padding-bottom:50px;">
                        <table id="cuisineTable" class="table table-striped table-bordered responsive">
                            <thead class="">
                                <tr>
                                    <th>Cuisine Name</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cuisines as $cuisine)
                                <tr>
                                    <td>{{$cuisine['cuisine_name']}}</td>
                                    <td class="table-action">
                                        <a href="#" data-toggle="tooltip" title="Edit" class="tooltips"><i class="fa fa-pencil"></i></a>
                                        <a href="#" data-toggle="tooltip" title="Delete" class="delete-row tooltips"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                    <div class="col-sm-6 col-md-6 col-xs-12" style="padding-bottom:50px;">
                        <form class="form-horizontal form-bordered">
                            <h5 style="font-weight:bold">Add New Cuisine</h5>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" style="text-align:left;">New Cuisine Name *</label>
                                <div class="col-sm-9">
                                    <input type="text" value="" class="form-control" required />
                                </div>
                            </div><!-- form-group -->
                            <br>
                            <button style="margin-left:15px;" type="submit" class="btn btn-primary">Add</button>
                        </form>
                    </div>
                </div><!-- panel -->
                <hr>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-xs-12" style="padding-bottom:20px;">
                        <h3 style="font-weight:bold">Blurb Category</h3>
                    </div>
                    <div class="col-sm-6 col-md-6 col-xs-12" style="padding-bottom:50px;">
                        <table id="catTable" class="table table-striped table-bordered responsive">
                            <thead class="">
                                <tr>
                                    <th>Blurb Category Name</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Discount</td>
                                    <td class="table-action">
                                        <a href="edit-blurb.html" data-toggle="tooltip" title="Edit" class="tooltips"><i class="fa fa-pencil"></i></a>
                                        <a href="" data-toggle="tooltip" title="Delete" class="delete-row tooltips"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Freebies</td>
                                    <td class="table-action">
                                        <a href="edit-blurb.html" data-toggle="tooltip" title="Edit" class="tooltips"><i class="fa fa-pencil"></i></a>
                                        <a href="" data-toggle="tooltip" title="Delete" class="delete-row tooltips"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-6 col-md-6 col-xs-12" style="padding-bottom:50px;">
                        <form class="form-horizontal form-bordered">
                            <h5 style="font-weight:bold">Add New Blurb Category</h5>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" style="text-align:left;">New Blurb Category Name *</label>
                                <div class="col-sm-9">
                                    <input type="text" value="" class="form-control" required />
                                </div>
                            </div><!-- form-group -->
                            <br>
                            <button style="margin-left:15px;" type="submit" class="btn btn-primary">Add</button>
                        </form>
                    </div>
                </div><!-- panel -->
            </div><!-- contentpanel -->
        </div><!-- mainpanel -->
    </div><!-- mainwrapper -->
</section>

@endsection

@section('custom-js')

@end
