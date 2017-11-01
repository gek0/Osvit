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
    {{ HTML::style('css/main.css') }}
    {{ HTML::style('css/style.css') }}
    {{ HTML::style('css/queries.css') }}
    {{ HTML::style('https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.2/sweetalert2.min.css') }}
</head>
<body>
<!--[if lt IE 9]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<!-- facebook SDK -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.9";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<!-- end facebook SDK -->

<header role="banner" id="fh5co-header">
    <div class="container">
        <!-- <div class="row"> -->
        <nav class="navbar navbar-default">
            <div class="navbar-header">
                <!-- Mobile Toggle Menu Button -->
                <a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"><i></i></a>
                <a class="navbar-brand" href="index.html">Elate</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="#" data-nav-section="home"><span>Home</span></a></li>
                    <li><a href="#" data-nav-section="work"><span>Work</span></a></li>
                    <li><a href="#" data-nav-section="testimonials"><span>Testimonials</span></a></li>
                    <li><a href="#" data-nav-section="services"><span>Services</span></a></li>
                    <li><a href="#" data-nav-section="about"><span>About</span></a></li>
                    <li><a href="#" data-nav-section="contact"><span>Contact</span></a></li>
                </ul>
            </div>
        </nav>
        <!-- </div> -->
    </div>
</header>