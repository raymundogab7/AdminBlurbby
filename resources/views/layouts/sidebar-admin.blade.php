<div class="leftpanel">
    <div class="media profile-left">
        <a class="pull-left profile-thumb-rounded" href="admin-profile-admin.html">
            <img class="img-circle" src="{{asset('images/photos/profile.png')}}" alt="">
        </a>
        <div class="media-body">
            <h4 class="media-heading">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</h4>
            <small class="text-muted">Super Admin</small>
        </div>
    </div><!-- media -->

    <h5 class="leftpanel-title">Navigation</h5>
    <ul class="nav nav-pills nav-stacked">
        <li class="@if(strpos(url()->current(), 'dashboard')) active @endif"><a href="{{url('dashboard')}}"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
        <li class="@if(strpos(url()->current(), 'featured-section')) active @endif"><a href="{{url('featured-section')}}"><i class="fa fa-star"></i> <span>Featured Section</span></a></li>
        <li class="@if(strpos(url()->current(), 'campaigns')) active @endif"><a href="{{url('campaigns')}}"><span class="pull-right badge">4</span><i class="fa fa-tags"></i> <span>Campaigns</span></a></li>
        <li class="@if(strpos(url()->current(), 'merchants')) active @endif"><a href="{{url('merchants')}}"><span class="pull-right badge">2</span><i class="fa fa-cutlery"></i> <span>Merchants</span></a></li>
        <li class="@if(strpos(url()->current(), 'administrators')) active @endif"><a href="{{url('administrators')}}"><i class="fa fa-user-secret"></i> <span>Administrators</span></a></li>
        <li class="@if(strpos(url()->current(), 'app-users')) active @endif"><a href="{{url('app-users')}}"><span class="pull-right badge">6</span><i class="fa fa-user"></i> <span>App Users</span></a></li>
        <li class="@if(strpos(url()->current(), 'blurb-reports')) active @endif"><a href="{{url('blurb-reports')}}"><span class="pull-right badge">1</span><i class="fa fa-exclamation-circle"></i> <span>Blurb Reports</span></a></li>
        <li class="@if(strpos(url()->current(), 'pages')) active @endif"><a href="{{url('pages/5/edit')}}"><i class="fa fa-file-text"></i> <span>Pages</span></a></li>
        <li class="@if(strpos(url()->current(), 'settings')) active @endif"><a href="{{url('settings')}}"><i class="fa fa-gear"></i> <span>Settings</span></a></li> <!-- Add new cuisine and blurb category -->
        <li><a href="{{url('logout')}}"><i class="fa fa-sign-out"></i> <span>Log Out</span></a></li>
    </ul>
</div><!-- leftpanel -->
