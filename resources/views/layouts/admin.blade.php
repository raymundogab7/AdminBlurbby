<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="http://blurbes.com/images/favicon.png" type="image/x-icon"/ >
        <title>@yield('page-title') | Blurbes Dashboard</title>

        @include('layouts.blurbby-admin-css')

        @yield('custom-css')
        <style type="text/css">
            input[type=number]::-webkit-inner-spin-button,
            input[type=number]::-webkit-outer-spin-button {
              -webkit-appearance: none;
              margin: 0;
            }
        </style>
    </head>

    <body>
    <?php //$camps = Admin\Notification::select('campaign.id as cid', 'campaign.campaign_name', 'campaign.admin_id as cmid', 'notification.*')
//->leftJoin('campaign', 'notification.campaign_id', '=', 'campaign.id')
//->where('notification.admin_id', Auth::user()->id)
//->orderBy('notification.updated_at', 'DESC')
//->get()
//->toArray();, ['camps'=> $camps] ;?>
        @include('layouts.nav-admin')

        @yield('body-contents')

        @include('layouts.blurbby-admin-js')

        @yield('custom-js')
    </body>
</html>
