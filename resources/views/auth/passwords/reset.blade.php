@extends('layouts.login')

@section('body-contents', 'Forgot Password')

@section('body-contents')
<section>
    <div class="panel panel-signin">
        <div class="panel-body">
            <div class="logo text-center">
                <img src="{{asset('images/logo-blue-big.png')}}" alt="Blurbby Logo" >
            </div>
            <br />
            <h4 class="text-center mb5">Forgot Password?</h4>
            <p class="text-center">Dont worry just fill in your email and will help you reset your password.</p>

            <div class="mb30"></div>

            <form action="index.html" method="post">

                {{ csrf_field() }}

                <div class="input-group mb15">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input type="email" name="email" class="form-control" placeholder="Email Address" required />
                </div><!-- input-group -->


              <div class="clearfix">
                    <div class="pull-left"></div>
                    <div class="pull-right">
                      <button type="submit" class="btn btn-success">Reset Password <i class="fa fa-angle-right ml5"></i></button>
                    </div>
                </div>
            </form>

        </div><!-- panel-body -->
        <div class="panel-footer">
            <a href="{{url('login')}}" class="btn btn-primary btn-block">Cancel</a>
        </div><!-- panel-footer -->
    </div><!-- panel -->

</section>
@endsection
