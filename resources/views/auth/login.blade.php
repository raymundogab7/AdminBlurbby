@extends('layouts.login')

@section('page-title', 'Sign in')

@section('body-contents')

<section>
    <div class="panel panel-signin">
        <div class="panel-body">
            <div class="logo text-center">
                <img src="images/logo-blue-big.png" alt="Blurbby Logo" class="main-logo" >
            </div>
            <br />
            <h4 class="text-center mb5">Welcome Merchant!</h4>
            <p class="text-center">Sign in to your account below.</p>

            <div class="mb30"></div>

            {!! Form::open(array('url' => 'authenticate', 'class' => 'col s12', 'id' => 'form_login', 'class' => 'basicForm')) !!}

                @if(count($errors) > 0)

                    <div class="alert alert-danger">
                        <strong>Incorrect email or password.</strong>
                    </div>

                @endif

                @if(session('message'))

                    <div class="alert alert-success">
                        <strong>{{session('message')}}</strong>
                    </div>

                @endif

                <div class="input-group mb15">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    
                    {!! Form::email('email', null, ['placeholder'=>'Email Address', 'required' => 'required', 'class' => 'form-control'])!!}
                
                </div><!-- input-group -->
                <div class="input-group mb15">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input type="password" name="password" class="form-control" placeholder="Password" required />
                </div><!-- input-group -->

                <div class="clearfix">
                    <div class="pull-left">
                        <div class="ckbox ckbox-primary mt10">
                            <input type="checkbox" id="rememberMe" name="remember">
                            <label for="rememberMe">Remember Me</label>
                        </div>
                    </div>
                    <div class="pull-right">
                        <button class="btn btn-success">Sign In <i class="fa fa-angle-right ml5"></i></button>
                    </div>
                </div>
            </form>

            {!! Form::close() !!}

        </div><!-- panel-body -->
        <div class="panel-footer">
            <a href="{{url('register')}}" class="btn btn-primary btn-block">Not yet our Merchant? Create Account Now</a>
        </div><!-- panel-footer -->
    </div><!-- panel -->
</section>

@endsection
