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

<section id="osvit-gallery" data-section="gallery">
    <div class="container">
        <div class="row">
            <div class="col-md-12 section-heading text-center">
                <h2 class="to-animate">Galerija slika</h2>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 subtext to-animate">
                        <h3>Jedna slika govori više nego tisuću riječi.<br>A mi ih imamo {{ count($image_gallery_data) }}.</h3>
                    </div>
                </div>
            </div>
        </div>

        @include('public.gallery-shared-output')

        <p class="text-center">
            <a href="{{ route('home') }}" class="btn btn-sm animated-button victoria-two">
                <i class="fa fa-home" aria-hidden="true"></i> Povratak na naslovnicu
            </a>
        </p>
    </div>
</section>

@include('public.layout.footer')