@extends('layouts.admin')

@section('page-title', 'Featured Slide')

@section('custom-css')

<link href="{{asset('css/morris.css')}}" rel="stylesheet">
<link href="{{asset('css/style.datatables.css')}}" rel="stylesheet">
<link href="//cdn.datatables.net/responsive/2.1.0/css/responsive.dataTables.min.css" rel="stylesheet">
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
                        <form class="form-horizontal form-bordered">
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label" style="text-align:left;">Position *</label>
                                <div class="col-sm-8">
                                    <select id="position" data-placeholder="Choose One" class="width300">
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
                                    <select id="merchant" data-placeholder="Choose One" class="width300">
                                        <option value="">Choose One</option>
                                        <option value="Mcdonald's" selected="selected">Mcdonald's</option>
                                        <option value="Starbucks">Starbucks</option>
                                    </select>
                                </div>
                            </div><!-- form-group -->
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label" style="text-align:left;">Slide Image *</label>
                                <div class="col-sm-5">
                                    <input name="file" type="file" />
                                    <span class="help-block">Must be at least 800px x 400px.</span>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label" style="text-align:left;">Status *</label>
                                <div class="col-sm-8">
                                    <select id="status" data-placeholder="Choose One" class="width300">
                                        <option value="">Choose One</option>
                                        <option value="Published">Published</option>
                                        <option value="Unpublished" selected="selected">Unpublished</option>
                                    </select>
                                </div>
                            </div><!-- form-group -->
                            <br>
                            <button style="margin-left:15px;" type="submit" class="btn btn-primary">Update</button>
                            <button style="margin-left:15px;" class="btn btn-danger">Delete</button>
                        </form>
                    </div><!-- row -->  
                
                </div><!-- contentpanel -->
            </div><!-- mainpanel -->
        </div><!-- mainwrapper -->
    </section>
@endsection