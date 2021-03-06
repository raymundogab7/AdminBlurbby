<div class="leftpanel">
    <div class="media profile-left">
        <a class="pull-left profile-thumb-rounded" href="{{url('administrators/'.Auth::user()->id.'/edit')}}">
            @if(Auth::user()->profile_photo == null || Auth::user()->profile_photo == '')
            <img class="img-circle" src="{{asset('images/photos/profile.png')}}" alt="">
            @else

            <img class="img-circle" src="{{asset(Auth::user()->profile_photo)}}"  alt="" />
            @endif

        </a>
        <div class="media-body">
            <h4 class="media-heading">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</h4>
            <small class="text-muted">{{(Auth::user()->role_id == 1) ? 'Super Administrator' : 'Administrator'}}</small>
        </div>
    </div><!-- media -->

    <h5 class="leftpanel-title">Navigation</h5>
    <ul class="nav nav-pills nav-stacked">
        <li class="@if(strpos(url()->current(), 'dashboard')) active @endif"><a href="{{url('dashboard')}}"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
        <li class="@if(strpos(url()->current(), 'featured-section')) active @endif"><a href="{{url('featured-section')}}"><i class="fa fa-star"></i> <span>Featured Section</span></a></li>
        <li class="@if(strpos(url()->current(), 'campaigns')) active @endif"><a href="{{url('campaigns')}}"><span class="pull-right badge">@if($campaign_count = \Admin\Campaign::where('cam_status', 'Pending Approval')->count()) {{$campaign_count}} @endif</span><i class="fa fa-tags"></i> <span>Campaigns</span></a></li>
        <li class="@if(strpos(url()->current(), 'merchants')) active @endif"><a href="{{url('merchants')}}"><span class="pull-right badge">@if($merchant_count = \Admin\Merchant::where('status', 0)->count()) {{$merchant_count}} @endif</span><i class="fa fa-cutlery"></i> <span>Merchants</span></a></li>
        <li class="@if(strpos(url()->current(), 'administrators')) active @endif"><a href="{{url('administrators')}}"><i class="fa fa-user-secret"></i> <span>Administrators</span></a></li>
        <li class="@if(strpos(url()->current(), 'app-users')) active @endif"><a href="{{url('app-users')}}"><span class="pull-right badge"></span><i class="fa fa-user"></i> <span>App Users</span></a></li>
        <li class="@if(strpos(url()->current(), 'blurb-reports')) active @endif"><a href="{{url('blurb-reports?page=1')}}"><span class="pull-right badge">@if($notified_count = \Admin\BlurbReport::where('notified', 0)->count()) {{$notified_count}} @endif</span><i class="fa fa-exclamation-circle"></i> <span>Blurb Reports</span></a></li>
        <li class="@if(strpos(url()->current(), 'pages')) active @endif"><a href="{{url('pages/5/edit')}}"><i class="fa fa-file-text"></i> <span>Pages</span></a></li>
        <li class="@if(strpos(url()->current(), 'settings')) active @endif"><a href="{{url('settings')}}"><i class="fa fa-gear"></i> <span>Settings</span></a></li> <!--$app_user_count = \Admin\AppUser::where('status', 'Disabled')->count()) $app_user_count Add new cuisine and blurb category -->
        <li><a href="{{url('logout')}}"><i class="fa fa-sign-out"></i> <span>Log Out</span></a></li>
    </ul>
</div><!-- leftpanel -->
