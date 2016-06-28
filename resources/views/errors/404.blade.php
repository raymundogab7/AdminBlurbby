<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>404 Page Not Found | Blurbby Dashboard</title>

        @include('layouts.blurbby-admin-css')
    </head>

    <body>

        <section>
            <div class="notfoundpanel">
                <h1>404!</h1>
                <h3>The page you are looking for has not been found!</h3>
                <p>The page you are looking for might have been removed, had its name changed, or unavailable.</p>

                    <a href="{{url('dashboard')}}"><button class="btn btn-primary"><i class="fa fa-home"></i> Back to Dashboard</button></a>

            </div><!-- notfoundpanel -->
        </section>

        @include('layouts.blurbby-admin-js')

    </body>
</html>
