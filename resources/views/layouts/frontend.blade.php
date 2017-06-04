<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', config('app.name'))</title>
        <meta name="description" content="description">
        <meta name="keywords" content="keywords">
        <meta property="og:url" content="{!! Request::url() !!}" />
        <meta property="og:type"   content="website" />
        <meta property="og:image:type" content="image/jpeg">
        <meta property="og:image:width" content="300">
        <meta property="og:image:height" content="300">
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="apple-touch-icon" href="/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic|Playfair+Display:400,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
        
        {{ HTML::style('vendor/bootstrap/css/bootstrap.min.css') }}
        {{ HTML::style('vendor/font-awesome/css/font-awesome.min.css') }}
        {{ HTML::style(mix('assets/css/frontend/plugins.css')) }}
        @stack('prestyles')
        {{ HTML::style(mix('assets/css/frontend/app.css')) }}
        @stack('afterstyles')
    </head>
    <body class="mg-boxed royal_loader">
        <div class="page">
            @include('frontend._partials.topbar')
            @include('frontend._partials.header')
            <div class="main-content">
                <div class="container">
                    @yield('page-content')
                </div>
            </div>
            @include('frontend._partials.footer')
        </div>
        {{ HTML::script('vendor/jquery/jquery.min.js') }}
        @stack('prescripts')
        {{ HTML::script('assets/js/frontend/app.js') }}
        @stack('afterscripts')
        <script>
            (function($) {
                "use strict";

                Royal_Preloader.config({
                    mode:           'logo',
                    logo:           'assets/img/frontend/logo.png',
                    timeout:        0,
                    showInfo:       false,
                    opacity:        1,
                    background:     ['#fff']
                });
            })(jQuery);
        </script>
    </body>
</html>
