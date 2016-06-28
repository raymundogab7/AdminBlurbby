@extends('layouts.login')

@section('page-title', 'Signup')

@section('body-contents')

<section>
    <div class="panel panel-signup">
        <div class="panel-body">
            <div class="logo text-center">
                <img src="{{asset('images/logo-blue-big.png')}}" alt="Blurbby Logo" class="main-logo">
            </div>
            <br />
            <h4 class="text-center mb5">Create a new account</h4>
            <p class="text-center">Please enter your credentials below.</p>

            <div class="mb30"></div>

            {!! Form::open(array('url' => 'register', 'class' => 'col s12', 'id' => 'form_login', 'class' => 'basicForm')) !!}

                @if(count($errors) > 0)

                    <div class="alert alert-danger">
                        <ul class="media-list">

                        @foreach($errors as  $v)

                            <li class="media">

                                  <strong> {{str_replace('.1', '', $v[0])}}</strong>

                            </li>

                        @endforeach

                        </ul>
                    </div>

                @endif

                <h4>Personal Details</h4>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="input-group mb15">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <!-- <input type="text" name="first_name" class="form-control" placeholder="First Name *"  /> -->
                            {!! Form::text('first_name', null, ['placeholder'=>'First Name *', 'required' => 'required', 'class' => 'form-control'])!!}
                        </div><!-- input-group -->
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group mb15">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <!-- <input type="text" name="last_name" class="form-control" placeholder="Last Name *"  /> -->
                            {!! Form::text('last_name', null, ['placeholder'=>'Last Name *', 'required' => 'required', 'class' => 'form-control'])!!}
                        </div><!-- input-group -->
                    </div>
                </div><!-- row -->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="input-group mb15">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            <!-- <input type="email" name="email" class="form-control" placeholder="Company Email Address *"  /> -->
                            {!! Form::email('email', null, ['placeholder'=>'Company Email Address *', 'required' => 'required', 'class' => 'form-control'])!!}
                        </div><!-- input-group -->
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group mb15">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            <!-- <input type="email" name="email_confirmation" class="form-control" placeholder="Company Email Address Again *"  /> -->
                            {!! Form::email('email_confirmation', null, ['placeholder'=>'Company Email Address Again *', 'required' => 'required', 'class' => 'form-control'])!!}
                        </div><!-- input-group -->
                    </div>
                </div><!-- row -->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="input-group mb15">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <!-- <input type="password" name="password" class="form-control" placeholder="Password *"  /> -->
                            {!! Form::password('password', ['placeholder'=>'Password *', 'required' => 'required', 'class' => 'form-control'])!!}
                        </div><!-- input-group -->
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group mb15">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <!-- <input type="password" name="password_confirmation" class="form-control" placeholder="Password Confirm *"  /> -->
                            {!! Form::password('password_confirmation', ['placeholder'=>'Password Confirm *', 'required' => 'required', 'class' => 'form-control'])!!}
                        </div><!-- input-group -->
                    </div>
                </div><!-- row -->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="input-group mb15">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                            <!-- <input type="text" name="phone_number" class="form-control" placeholder="Contact Number *"  /> -->
                            {!! Form::text('phone_number', null, ['placeholder'=>'Contact Number *', 'required' => 'required', 'class' => 'form-control'])!!}
                        </div><!-- input-group -->
                    </div>
                </div><!-- row -->
                <br />
                <h4>Company Details</h4>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="input-group mb15">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span>
                            <!-- <input type="text" name="coy_name" class="form-control" placeholder="Company Name *"  /> -->
                            {!! Form::text('coy_name', null, ['placeholder'=>'Company Name *', 'required' => 'required', 'class' => 'form-control'])!!}
                        </div><!-- input-group -->
                    </div>
                    <div class="col-sm-12">
                        <div class="input-group mb15">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
                            <!-- <input type="text" name="coy_add" class="form-control" placeholder="Company Registered Address *"  /> -->
                            {!! Form::text('coy_add', null, ['placeholder'=>'Company Registered Address *', 'required' => 'required', 'class' => 'form-control'])!!}
                        </div><!-- input-group -->
                    </div>
                </div><!-- row -->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="input-group mb15">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
                            <!-- <input type="text" name="coy_zip" class="form-control" placeholder="Postal Code *"  /> -->
                            {!! Form::text('coy_zip', null, ['placeholder'=>'Postal Code *', 'required' => 'required', 'class' => 'form-control'])!!}
                        </div><!-- input-group -->
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group mb15">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt"></i></span>
                            <!-- <input type="text" name="coy_phone" class="form-control" placeholder="Company Phone Number *"  /> -->
                            {!! Form::text('coy_phone', null, ['placeholder'=>'Company Phone Number *', 'required' => 'required', 'class' => 'form-control'])!!}
                        </div><!-- input-group -->
                    </div>
                </div><!-- row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="input-group mb15">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
                            <!-- <input type="text" name="coy_url" class="form-control" placeholder="Company Website URL"> -->
                            {!! Form::text('coy_url', null, ['placeholder'=>'Company Website URL', 'class' => 'form-control'])!!}
                        </div><!-- input-group -->
                    </div>
                </div><!-- row -->
                <br />
                <h4>Restaurant & Main Outlet Details</h4>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="input-group mb15">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-cutlery"></i></span>
                            <!-- <input type="text" name="res_name" class="form-control" placeholder="Restaurant Name *"  /> -->
                            {!! Form::text('res_name', null, ['placeholder'=>'Restaurant Name *', 'required' => 'required', 'class' => 'form-control'])!!}
                        </div><!-- input-group -->
                    </div>
                    <div class="col-sm-12">
                        <div class="input-group mb15">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
                            <!-- <input type="text" name="outlet_add" class="form-control" placeholder="Main Outlet Address *"  /> -->
                            {!! Form::text('outlet_add', null, ['placeholder'=>'Main Outlet Address *', 'required' => 'required', 'class' => 'form-control'])!!}
                        </div><!-- input-group -->
                    </div>
                </div><!-- row -->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="input-group mb15">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
                            <!-- <input type="text" name="outlet_zip" class="form-control" placeholder="Main Outlet Postal Code *"  /> -->
                            {!! Form::text('outlet_zip', null, ['placeholder'=>'Main Outlet Postal Code *', 'required' => 'required', 'class' => 'form-control'])!!}
                        </div><!-- input-group -->
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group mb15">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt"></i></span>
                            <!-- <input type="text" name="outlet_phone" class="form-control" placeholder="Main Outlet Phone Number *"  /> -->
                            {!! Form::text('outlet_phone', null, ['placeholder'=>'Main Outlet Phone Number *', 'required' => 'required', 'class' => 'form-control'])!!}
                        </div><!-- input-group -->
                    </div>
                </div><!-- row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="input-group mb15">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
                            <!-- <input type="text" name="res_url" class="form-control" placeholder="Restaurant Website URL"> -->
                            {!! Form::text('res_url', null, ['placeholder'=>'Restaurant Website URL', 'class' => 'form-control'])!!}
                        </div><!-- input-group -->
                    </div>
                </div><!-- row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="input-group mb15">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-tags"></i></span>

                            {!! Form::select('cuisine_id[]', $cuisines, null, ['id' => 'select-multi', 'multiple'=>'multiple', 'required' => 'required',  'class' => 'width300', 'style' => 'width:100%', 'data-placeholder' => 'Restaurant Cuisine *']) !!}

                        </div>
                    </div>
                </div>

                <p>* More outlets can be added after your account has been created.</p>
                <br />
                <div class="clearfix">
                    <div class="pull-left">
                        <div class="ckbox ckbox-primary mt5">
                            <input type="checkbox" value="1" id="agree" name="tnc[]" required />
                            <label for="agree">I agree with <a href="#">Terms and Conditions</a></label>
                        </div>
                    </div>
                    <div class="pull-right">
                        <button type="submit" class="btn btn-success">Create New Account <i class="fa fa-angle-right ml5"></i></button>
                    </div>
                </div>
                <input type="hidden" name="main" class="form-control" value="1">
            {!! Form::close() !!}

        </div><!-- panel-body -->
        <div class="panel-footer">
            <a href="{{url('login')}}" class="btn btn-primary btn-block">Already our Merchant? Sign In Here</a>
        </div><!-- panel-footer -->
    </div><!-- panel -->
</section>

@endsection

@section('custom-js')
<script>
    // Select2
    jQuery("#select-basic, #select-multi").select2();
    jQuery('#select-search-hide').select2({
        minimumResultsForSearch: -1
    });
</script>
@endsection
