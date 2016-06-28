<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>@yield('page-title') | Blurbes Dashboard</title>

        @include('layouts.blurbby-admin-css')

    </head>

    <body class="signin">

        @yield('body-contents')

        @include('layouts.blurbby-admin-js')

        @yield('custom-js')
    </body>
</html>
