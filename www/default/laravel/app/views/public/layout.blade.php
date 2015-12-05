<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>nimbus</title>
    <meta name="author" content="" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <!-- Favicon -->
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="icon" href="/favicon.ico" type="image/x-icon" />
    <!-- CSS -->
    {{ HTML::style('_css/global.css'); }}
    <!-- Scripts -->
    <!-- https://code.jquery.com/jquery-2.1.4.min.js -->
    {{ HTML::script('/_js/jquery-2.1.4.min.js') }}
    <!-- https://cdnjs.cloudflare.com/ajax/libs/three.js/r73/three.min.js -->
    {{ HTML::script('/_js/three.min.js') }}
    {{ HTML::script('/_js/three/OrbitControls.js') }}
    {{ HTML::script('/_js/three/Projector.js') }}
    {{ HTML::script('/_js/Tween.js') }}
    {{ HTML::script('/_js/nimbus.js') }}
</head>
<body>
    @yield('content')
    @include('public.partials.header')
</body>
</html>
