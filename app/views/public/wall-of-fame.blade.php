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
                <h2 class="to-animate">Wall of Fame</h2>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 subtext to-animate">
                        <h3>Naši najsjajniji sportaši.</h3>

                        @if($athletes_data)
                            <div class="row padded">
                                @foreach($athletes_data as $athlete)
                                        <div class="col-md-6 thumbnail news-all-content athlete-content">
                                            <div class="news-all-header">
                                                @if($athlete->athlete_profile_image)
                                                    <img src="{{ URL::to('/'.getenv('ATHLETES_UPLOAD_DIR').'/'.$athlete->athlete_profile_image) }}" alt="{{ imageAlt($athlete->athlete_profile_image) }}" class="img-responsive img-circle img-real-circle lazy" />
                                                @else
                                                    @if($athlete->athlete_gender == 'male')
                                                        <img src="{{ url('css/assets/images/athletes/male_athlete_icon.png') }}" alt="Male profile image" class="img-responsive img-circle img-real-circle lazy" />
                                                    @else
                                                        <img src="{{ url('css/assets/images/athletes/female_athlete_icon.png') }}" alt="Female profile image" class="img-responsive img-circle img-real-circle lazy" />
                                                    @endif
                                                @endif

                                                <h3 class="text-center">
                                                    {{ $athlete->athlete_full_name }}
                                                </h3>

                                                <div class="news-all-header-title">
                                                    <hr>
                                                    <span>
                                                        @if($athlete->athlete_trophy === 'bronze')
                                                            <i class="fa fa-trophy fa-big bronze-btn" title="Bronca"></i>
                                                        @elseif($athlete->athlete_trophy === 'silver')
                                                            <i class="fa fa-trophy fa-big silver-btn" title="Srebro"></i>
                                                        @else
                                                            <i class="fa fa-trophy fa-big gold-btn" title="Zlato"></i>
                                                        @endif
                                                    </span>
                                                    <p class="short-info-paragraph">
                                                        {{ removeEmptyP(nl2p((new BBCParser)->parse($athlete->athlete_description))) }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                @endforeach
                            </div>
                        @else
                            <h4>Još nismo nikoga objavili, dođite uskoro... :)</h4>
                        @endif
                    </div>
                </div>

                <p class="text-center">
                    <a href="{{ route('home') }}" class="btn btn-sm animated-button victoria-two">
                        <i class="fa fa-home" aria-hidden="true"></i> Povratak na naslovnicu
                    </a>
                </p>
            </div>
        </div>
    </div>
</section>

@include('public.layout.footer')