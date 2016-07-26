@extends('layouts.admin')

@section('page-title', 'Settings')

@section('custom-css')

<link href="{{asset('css/dropzone.css')}}" rel="stylesheet">
<link href="{{asset('css/bootstrap-timepicker.min.css')}}" rel="stylesheet">

<link href="{{asset('css/style.datatables.css')}}" rel="stylesheet">
<link href="//cdn.datatables.net/responsive/2.1.0/css/responsive.dataTables.min.css" rel="stylesheet">
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
                                        <a href="#updateCuisineModal" data-cuisine-id="{{$cuisine['id']}}" data-cuisine-name="{{$cuisine['cuisine_name']}}" data-target="#updateCuisineModal" data-toggle="modal" title="Edit" class="delete-row tooltips"><i class="fa fa-pencil"></i></a>
                                        <a href="#deleteCuisineModal" data-cuisine-id="{{$cuisine['id']}}" data-cuisine-name="{{$cuisine['cuisine_name']}}" data-target="#deleteCuisineModal" data-toggle="modal" title="Delete" class="delete-row tooltips"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                    <div class="col-sm-6 col-md-6 col-xs-12" style="padding-bottom:50px;">
                        @if(session('message'))

                        <div class="alert alert-success">
                            <strong>{{session('message')}}</strong>
                        </div>

                        @endif

                        @if(session('message_error'))

                        <div class="alert alert-danger">
                            <strong>{{session('message_error')}}</strong>
                        </div>

                        @endif
                        <form action="{{url('settings/cuisine/store')}}" method="POST" class="form-horizontal form-bordered">
                            <h5 style="font-weight:bold">Add New Cuisine</h5>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" style="text-align:left;">New Cuisine Name *</label>
                                <div class="col-sm-9">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}" />
                                    <input type="text" name="cuisine_name" class="form-control" required />
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
                        <table id="blurbCategoryTable" class="table table-striped table-bordered responsive">
                            <thead class="">
                                <tr>
                                    <th>Blurb Category Name</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($blurb_category as $bc)
                                <tr>
                                    <td>{{$bc['blurb_cat_name']}}</td>
                                    <td class="table-action">
                                        <a href="#updateBlurbCategoryModal" data-cuisine-id="{{$bc['id']}}" data-cuisine-name="{{$bc['blurb_cat_name']}}" data-target="#updateBlurbCategoryModal" data-toggle="modal" title="Edit" class="delete-row tooltips"><i class="fa fa-pencil"></i></a>
                                        <a href="#deleteBlurbCategoryModal" data-cuisine-id="{{$bc['id']}}" data-cuisine-name="{{$bc['blurb_cat_name']}}" data-target="#deleteBlurbCategoryModal" data-toggle="modal" title="Delete" class="delete-row tooltips"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                    <div class="col-sm-6 col-md-6 col-xs-12" style="padding-bottom:50px;">
                        <form action="{{url('settings/cuisine/store')}}" method="POST" class="form-horizontal form-bordered">
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

<!-- UPDATE CUISINE MODAL -->
<div class="modal fade updateCuisineModal" id="updateCuisineModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Update Cuisine</h4>
      </div>
      {!! Form::open(array('url' => '', 'class' => 'form-horizontal form-bordered update-cuisine-form')) !!}
      <div class="modal-body">
        <input name="_method" type="hidden" value="PUT">
        <input type="hidden" id="ucuisine_id" name="cuisine_id">
        <label class="col-sm-3 control-label" style="text-align:left;">Cuisine Name *</label>
        <input type="text" id="cuisine_name" name="cuisine_name" class="form-control">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        <button class="btn btn-primary update-cuisine-yes">Yes</button>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>

<!-- DELETE CUISINE MODAL -->
<div class="modal fade deleteCuisineModal" id="deleteCuisineModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete Cuisine</h4>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this cuisine?
      </div>
      <div class="modal-footer">

        {!! Form::open(array('url' => '', 'class' => 'form-horizontal form-bordered delete-cuisine-form')) !!}

        <input name="_method" type="hidden" value="DELETE">
        <input type="hidden" id="cuisine_id" name="cuisine_id">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        <button class="btn btn-primary delete-cuisine-yes">Yes</button>

        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endsection

@section('custom-js')
<script type="text/javascript" src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="//cdn.datatables.net/plug-ins/725b2a2115b/integration/bootstrap/3/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js"></script>

<script type="text/javascript">
    $('.updateCuisineModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var cuisine_id = button.data('cuisine-id');
        var cuisine_name = button.data('cuisine-name');
        var modal = $(this);
        modal.find('.modal-title').html('Update ' + cuisine_name);
        modal.find('.modal-body #ucuisine_id').val(cuisine_id);
        modal.find('.modal-body #cuisine_name').val(cuisine_name);
        $('.update-cuisine-form').attr('action', '/settings/cuisine/'+cuisine_id);
    });
    $('.deleteCuisineModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var cuisine_id = button.data('cuisine-id');
        var cuisine_name = button.data('cuisine-name');
        var modal = $(this);
        modal.find('.modal-title').html('Delete ' + cuisine_name);
        modal.find('.modal-footer #cuisine_id').val(cuisine_id);
        $('.delete-cuisine-form').attr('action', '/settings/cuisine/'+cuisine_id);
    });

    $('.updateBlurbCategoryModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var cuisine_id = button.data('blurb-category-id');
        var cuisine_name = button.data('cuisine-name');
        var modal = $(this);
        modal.find('.modal-title').html('Update ' + cuisine_name);
        modal.find('.modal-body #ucuisine_id').val(cuisine_id);
        modal.find('.modal-body #cuisine_name').val(cuisine_name);
        $('.update-cuisine-form').attr('action', '/settings/cuisine/'+cuisine_id);
    });
    $('.deleteBlurbCategoryModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var cuisine_id = button.data('cuisine-id');
        var cuisine_name = button.data('cuisine-name');
        var modal = $(this);
        modal.find('.modal-title').html('Delete ' + cuisine_name);
        modal.find('.modal-footer #cuisine_id').val(cuisine_id);
        $('.delete-cuisine-form').attr('action', '/settings/cuisine/'+cuisine_id);
    });
    jQuery(document).ready(function(){

        jQuery('#cuisineTable').DataTable({
            responsive: true,
            order: []
        });

        var shTable = jQuery('#shTable').DataTable({
            "fnDrawCallback": function(oSettings) {
                jQuery('#shTable_paginate ul').addClass('pagination-active-dark');
            },
            responsive: true
        });

        jQuery('#blurbCategoryTable').DataTable({
            responsive: true,
            order: []
        });

        var shTable = jQuery('#shTable').DataTable({
            "fnDrawCallback": function(oSettings) {
                jQuery('#shTable_paginate ul').addClass('pagination-active-dark');
            },
            responsive: true
        });
    });
</script>
@endsection
