<header>
    <div class="headerwrapper">
        <div class="header-left">
            <a href="{{url('dashboard')}}" class="logo">
                <img src="{{asset('images/logo.png')}}" alt="" class="side-logo" />
            </a>
            <div class="pull-right">
                <a href="" class="menu-collapse">
                    <i class="fa fa-bars"></i>
                </a>
            </div>
        </div><!-- header-left -->

        <div class="header-right">

            <div class="pull-right">

                <div class="btn-group btn-group-list btn-group-notification">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-bell-o"></i>
                      
                    </button>
                    <div class="dropdown-menu pull-right">
                        <h5>Notifications</h5>

                            

                        <div class="dropdown-footer text-center">
                            <a href="{{url('notifications')}}" class="link">See All Notifications</a>
                        </div>
                    </div><!-- dropdown-menu -->
                </div><!-- btn-group -->

                <div class="btn-group btn-group-option">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-caret-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-right" role="menu">
                      <li><a href="{{url('merchant-profile')}}"><i class="glyphicon glyphicon-cutlery"></i> My Profile</a></li>
                      <li><a href="{{url('logout')}}"><i class="glyphicon glyphicon-log-out"></i>Log Out</a></li>
                    </ul>
                </div><!-- btn-group -->

            </div><!-- pull-right -->

        </div><!-- header-right -->

    </div><!-- headerwrapper -->
</header>
