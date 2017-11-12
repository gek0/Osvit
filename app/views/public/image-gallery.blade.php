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

<section id="osvit-gallery">
    <div class="container">
        <div class="row">
            <div class="col-md-12 section-heading text-center">
                <h2 class="to-animate">Galerija slika</h2>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 subtext to-animate">

        @if($image_gallery_data)
                        <div id="gallery-counters">
                            <h3>Jedna slika govori više nego tisuću riječi.<br>
                                A mi ih imamo <span class="js-counter" data-from="0" data-to="{{ count($image_gallery_data) }}" data-speed="1500" data-refresh-interval="50">{{ count($image_gallery_data) }}</span>.
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            @include('public.gallery-shared-output')

        @else
                        <h3>Jedna slika govori više nego tisuću riječi.</h3>
                    </div>
                </div>
            </div>
        </div>

            <div class="col-md-12 col-sm-12 col-xxs-12">
                <a href="{{ URL::to('https://via.placeholder.com/1920x1080?text=...no mi svoju još nismo objavili :)') }}" class="osvit-project-item image-popup to-animate">
                    <img src="{{ URL::to('https://via.placeholder.com/1920x1080?text=...no mi svoju još nismo objavili :)') }}" alt="{{ getenv('WEB_NAME') }}" class="img-responsive lazy">
                </a>
            </div>
        @endif

        <p class="text-center">
            <a href="{{ route('home') }}" class="btn btn-sm animated-button victoria-two">
                <i class="fa fa-home" aria-hidden="true"></i> Povratak na naslovnicu
            </a>
        </p>
    </div>
</section>

@include('public.layout.footer')