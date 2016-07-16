@extends('layouts.admin')

@section('page-title', 'Administrators')

@section('custom-css')

<link href="{{asset('css/bootstrap-timepicker.min.css')}}" rel="stylesheet">
@endsection

@section('body-contents')
	<section>
        <div class="mainwrapper">
            @include('layouts.sidebar-admin')
            <div class="mainpanel">
                <div class="pageheader">
                    <div class="media">
                        <div class="pageicon pull-left">
                            <i class="fa fa-user-secret"></i>
                        </div>
                        <div class="media-body">
                            <ul class="breadcrumb">
                                <li><a href="{{url('dashboard')}}"><i class="glyphicon glyphicon-home"></i></a></li>
                                <li><a href="{{url('administrators')}}">Administrators</a></li>
                                <li>Add New Administrator</li>
                            </ul>
                            <h4>Administrators</h4>
                        </div>
                    </div><!-- media -->
                </div><!-- pageheader -->
                <div class="contentpanel">
                    <div class="row">
                        <div class="col-sm-12 col-md-3 col-xs-12" style="padding-bottom:30px;max-width:417px;min-width:300px;">
                            <div style="border: 1px solid #ccc;">
                                <div class="text-center" style="background:url({{asset('images/profile-background.jpg')}});    background-size:cover;">
                                    <img src="{{asset('images/photos/profile-big.jpg')}}" class="img-circle img-offline img-responsive img-profile" style="max-width:80px;margin-top:45px;" alt="" />
                                    <h4 class="profile-name mb5" style="color:#fff;padding-bottom:45px;font-size:16px;margin-top:5px;">Royce Cheng</h4>
                                    
                                </div><!-- text-center -->
                                <div class="mb20"></div>
                                <div style="text-align:center;padding:10px 0;">Co-Founder</div>
                                <div class="mb20"></div>
                                <table style="width:100%;">
                                    <tbody>
                                        <tr style="border-top:1px solid #ccc;">
                                            <td style="width:50%;padding-left:25px;">First Name</td>
                                            <td style="padding:15px 25px 15px 0;text-align:right;">Royce</td>
                                        </tr>
                                        <tr style="border-top:1px solid #ccc;">
                                            <td style="width:50%;padding-left:25px;">Last Name</td>
                                            <td style="padding:15px 25px 15px 0;text-align:right;">Cheng</td>
                                        </tr>
                                        <tr style="border-top:1px solid #ccc;">
                                            <td style="width:50%;padding-left:25px;">Email</td>
                                            <td style="padding:15px 25px 15px 0;text-align:right;">roycecheng87@gmail.com</td>
                                        </tr>
                                        <tr style="border-top:1px solid #ccc;">
                                            <td style="width:50%;padding-left:25px;">Date Of Birth</td>
                                            <td style="padding:15px 25px 15px 0;text-align:right;">24-Jan-1991</td>
                                        </tr>
                                        <tr style="border-top:1px solid #ccc;">
                                            <td style="width:50%;padding-left:25px;">Gender</td>
                                            <td style="padding:15px 25px 15px 0;text-align:right;">Male</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- col-sm-4 col-md-3 -->
                    
                        <div class="col-sm-12 col-md-9 col-xs-12">
                            <form class="form-horizontal form-bordered">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">Registered on</label>
                                    <div class="col-sm-8">
                                        <p class="control-label" style="text-align:left;">12-May-2016 13:01:23</p>
                                    </div>
                                </div><!-- form-group -->
                                
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">Last online on</label>
                                    <div class="col-sm-8">
                                        <p class="control-label" style="text-align:left;">15-May-2016 15:21:33</p>
                                    </div>
                                </div><!-- form-group -->
                                
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">Status *</label>
                                    <div class="col-sm-8">
                                        <select id="status" data-placeholder="Choose One" class="width300">
                                            <option value="">Choose One</option>
                                            <option value="Approved" selected="selected">Approved</option>
                                            <option value="Pending Email Approval">Pending Email Approval</option>
                                            <option value="Blocked">Blocked</option>
                                        </select>
                                    </div>
                                </div><!-- form-group -->
                                
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">Type *</label>
                                    <div class="col-sm-8">
                                        <select id="type" data-placeholder="Choose One" class="width300">
                                            <option value="">Choose One</option>
                                            <option value="Super Administrator" selected="selected">Super Administrator</option>
                                            <option value="Administrator">Administrator</option>
                                        </select>
                                    </div>
                                </div><!-- form-group -->
                                
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">Title *</label>
                                    <div class="col-sm-8">
                                        <input type="text" value="Co-Founder" class="form-control" />
                                    </div>
                                </div><!-- form-group -->
                                
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">Profile Photo</label>
                                    <div class="col-sm-5">
                                        <input name="file" type="file" />
                                        <span class="help-block">Must be at least 500px x 500px.</span>
                                    </div>
                                </div>
                            
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">First Name *</label>
                                    <div class="col-sm-8">
                                        <input type="text" value="Royce" class="form-control" />
                                    </div>
                                </div><!-- form-group -->
                                
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">Last Name *</label>
                                    <div class="col-sm-8">
                                        <input type="text" value="Cheng" class="form-control" />
                                    </div>
                                </div><!-- form-group -->
        
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">Email *</label>
                                    <div class="col-sm-8">
                                        <input type="text" value="roycecheng87@gmail.com" class="form-control" />
                                    </div>
                                </div><!-- form-group -->
                                
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">Date Of Birth *</label>
                                    <div class="col-sm-2">
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="24-Jan-1991" id="datepicker" required>
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                        </div><!-- input-group -->
                                    </div>
                                </div><!-- form-group -->
                                
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">Gender *</label>
                                    <div class="col-sm-8">
                                        <select id="gender" data-placeholder="Choose One" class="width300">
                                            <option value="">Choose One</option>
                                            <option value="Female">Female</option>
                                            <option value="Male" selected="selected">Male</option>
                                        </select>
                                    </div>
                                </div><!-- form-group -->
                                
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">New Password</label>
                                    <div class="col-sm-8">
                                        <input type="password" placeholder="" class="form-control" />
                                    </div>
                                </div><!-- form-group -->
                                
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" style="text-align:left;">Confirm Password Again</label>
                                    <div class="col-sm-8">
                                        <input type="password" placeholder="" class="form-control" />
                                    </div>
                                </div><!-- form-group -->
                                <br>
                                <button style="margin-left:15px;" type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div><!-- tab-content -->
                          
                        </div><!-- col-sm-9 -->
                    </div><!-- row -->  
                
                </div><!-- contentpanel -->
                
            <input type="hidden" id="search_url" value="{{url('')}}">
@endsection

@section('custom-js')
<script type="text/javascript" src="{{asset('js/jquery-ui-1.10.3.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap-timepicker.min.js')}}"></script>
<script>
	// Select2
    jQuery('#status, #gender, #type').select2({
        minimumResultsForSearch: -1
    });
    
    // Date Picker
    jQuery('#datepicker').datepicker({ dateFormat: 'dd-M-yy',maxDate: 0 });
</script>
@endsection