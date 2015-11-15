<!DOCTYPE html>
<!--[if lt IE 9 ]><html class="lt-ie9" lang="de"><![endif]-->
<!--[if (gt IE 8)|!(IE)]><!--><html class="" lang="de"><!--<![endif]-->
<head>
    <meta charset="utf-8"/>
    <title>base</title>
    {{ HTML::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'); }}
    {{ HTML::style('css/style.css'); }}
    {{ HTML::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js') }}
    {{ HTML::script('https://code.jquery.com/jquery-1.11.3.min.js') }}
</head>
<body>
    <div class="container">
        @include('admin.partials.header')
        @yield('content')
        @include('admin.partials.footer')
    </div>
</body>
</html>
