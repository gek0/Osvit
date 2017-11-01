<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="hr" class="no-js lt-ie10 lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7 ]>    <html lang="hr" class="no-js lt-ie10 lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="hr" class="no-js lt-ie10 lt-ie9"> <![endif]-->
<!--[if IE 9 ]>    <html lang="hr" class="no-js lt-ie10"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="hr" class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title>Taekwondo "Osvit" :: {{ $page_title or 'Dobrodošli' }}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="taekwondo, osvit, klub, trening, tkd, hrvatska, sport, vještine, martial arts">
    <meta name="description" content="Taekwondo klub Osvit, jedan od najstarijih TKD klubova u Hrvatskoj">
    <meta name="author" content="Matija Buriša">

    <!-- Facebook integration -->
    <meta property="og:title" content="Taekwondo Osvit" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ Request::url('/') }}" />
    <meta property="og:site_name" content="Taekwondo klub Osvit" />
    <meta property="og:description" content="Taekwondo klub Osvit, jedan od najstarijih TKD klubova u Hrvatskoj" />

    <!-- favicons and apple icon -->
    <!--[if IE]><link rel="shortcut icon" href="{{ asset('favicon.ico') }}"><![endif]-->
    <link rel="icon" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('touch-icon-iphone.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('touch-icon-ipad.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('touch-icon-iphone-retina.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('touch-icon-ipad-retina.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('touch-icon-iphone-6-plus.png') }}">
    <link rel="canonical" href="{{ Request::url() }}" />

    <!-- scripts -->
    {{ HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.2/sweetalert2.all.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('js/bootstrap.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('js/bootstrap-select.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('js/modernizr-2.6.2.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('js/jquery.lazyload.min.js', ['charset' => 'utf-8']) }}
    <!--[if lt IE 9]>
    {{ HTML::script('js/html5shiv.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('js/respond.min.js', ['charset' => 'utf-8']) }}
    <![endif]-->

    <!-- stylesheets -->
    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/admin-main.css') }}
    {{ HTML::style('css/style.css') }}
    {{ HTML::style('css/queries.css') }}
    {{ HTML::style('wysibb/theme/default/wbbtheme.css') }}
    {{ HTML::style('https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.2/sweetalert2.min.css') }}
</head>
<body>
<!--[if lt IE 9]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<!-- notifications -->
<div class="notificationOutput" id="outputMsg">
    <div class="notificationTools" id="notifTool">
        <span class="fa fa-times fa-med" id="notificationRemove"></span>
        <span id="notificationTimer"></span>
    </div>
</div>

<section id="content-main">
    <div class="container-fluid">

        <div class="space-x3"></div>
        <section class="logo-placeholder">
            {{ HTML::image('css/assets/images/logo_main.png', 'Logo', ['title' => getenv('WEB_NAME'), 'class' => 'img-responsive']) }}
            <h1>{{ $page_title }}</h1>
        </section>

        <!-- Navigation -->
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <ul class="nav navbar-nav">
                            {{ HTML::smartRoute_link('/', 'Pregled stranice', '<i class="fa fa-search" aria-hidden="true"></i>') }}
                            {{ HTML::smartRoute_link('admin/naslovnica', 'Naslovnica', '<i class="fa fa-home" aria-hidden="true"></i>') }}
                            {{ HTML::smartRoute_link('admin/obavijesti', 'Obavijesti', '<i class="fa fa-pencil" aria-hidden="true"></i>') }}
                            {{ HTML::smartRoute_link('admin/dvorane', 'Dvorane', '<i class="fa fa-map-marker" aria-hidden="true"></i>') }}
                            {{ HTML::smartRoute_link('admin/video-galerija', 'Video galerija', '<i class="fa fa-video-camera" aria-hidden="true"></i>') }}
                            {{ HTML::smartRoute_link('admin/galerija', 'Galerija', '<i class="fa fa-camera" aria-hidden="true"></i>') }}
                            {{ HTML::smartRoute_link('admin/korisnici', 'Korisnici', '<i class="fa fa-users" aria-hidden="true"></i>') }}
                            {{ HTML::smartRoute_link('odjava', 'Odjava', '<i class="fa fa-sign-out" aria-hidden="true"></i>') }}
                        </ul>
                    </div>
                </nav>
            </div>
        </div>