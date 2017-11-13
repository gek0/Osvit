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
                <h2 class="to-animate">Lista tagova</h2>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 subtext to-animate">

                        {{ Form::open(array('url' => '', 'id' => 'live-search', 'role' => 'form')) }}
                            <div class="row">
                                <div class="col-md-5 text-center centered-col">
                                    <div class="form-group">
                                        {{ Form::label('filter', 'Pronađite tag:') }}
                                        {{ Form::text('filter', null, ['class' => 'form-control form-control-inverse', 'id' => 'filter', 'placeholder' => '...']) }}
                                        <span id="filter-count"></span>
                                    </div>
                                </div>
                            </div>
                        {{ Form::close() }}

                        @if($tags_data->count() > 0)
                            <div class="text-center tags-collection">
                                <ul class="tags">
                                    @foreach($tags_data as $tag)
                                        <a href="{{ route('news-tag', $tag->slug) }}">
                                            <li class="marginated-tags">{{ $tag->tag }}</li>
                                        </a>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="space"></div>
                        @else
                            <div class="text-center">
                                Trenutno nema tagova vijesti.
                            </div>
                            <div class="space"></div>
                        @endif

                        <p class="text-center space">
                            <a href="{{ route('news') }}" class="btn btn-sm animated-button animated-button-extended victoria-two">
                                <i class="fa fa-newspaper-o" aria-hidden="true"></i> Povratak na obavijesti
                            </a>
                            <a href="{{ route('home') }}" class="btn btn-sm animated-button animated-button-extended victoria-two">
                                <i class="fa fa-home" aria-hidden="true"></i> Povratak na naslovnicu
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('public.layout.footer')