@include('shared-layout.head')

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

@include('shared-layout.browser-fb')

<a href="#" id="back-to-top" title="Povratak na vrh">&uarr;</a>

<header role="banner" id="osvit-header">
    <div class="container">
        <!-- <div class="row"> -->
        <nav class="navbar navbar-default">
            <div class="navbar-header">
                <!-- Mobile Toggle Menu Button -->
                <a href="#" class="js-osvit-nav-toggle osvit-nav-toggle" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"><i></i></a>
                {{ HTML::image('css/assets/images/logo_main_small.png', 'Logo', ['title' => getenv('WEB_NAME'), 'class' => 'img-responsive logo-navbar']) }}
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="#" data-nav-section="home"><span>Naslovnica</span></a></li>
                    <li><a href="#" data-nav-section="gallery"><span>Galerija</span></a></li>
                    <li><a href="#" data-nav-section="about"><span>O nama</span></a></li>
                    <li><a href="#" data-nav-section="contact"><span>Kontakt</span></a></li>
                    <li><a href="#" data-nav-section="locations"><span>Lokacije</span></a></li>
                </ul>
            </div>
        </nav>
        <!-- </div> -->
    </div>
</header>