<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <!-- Laravel Javascript Validation -->
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    @yield('uplinks')
</head>
<body class="sb-nav-fixed">

    @include('temp.layout.header')

    <div id="layoutSidenav">

        <div id="layoutSidenav_nav">
            @yield('sidenav')
        </div>

        <div id="layoutSidenav_content">
            <main>
                @yield('rightsidenav')
            </main>

            @include('temp.layout.footer')
        </div>

    </div>

    @yield('downlinks')
    @yield('js-validation')
</body>
</html>
