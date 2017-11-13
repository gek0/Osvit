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
                <h2 class="to-animate">Obavijesti</h2>
                <h3 class="to-animate">Sva događanja na jednome mjestu.</h3>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 subtext to-animate">

                        <div class="formSort padded">
                            {{ Form::open(['url' => route('news-sort'), 'method' => 'GET', 'id' => 'formSort', 'role' => 'form']) }}
                                <div class="col-md-5">
                                    <div class="form-group">
                                        {{ Form::label('sort_option', 'Sortiranje vijesti:') }}<br>
                                        {{ Form::select('sort_option', ['Vrsta sortiranja...' => $sort_data],
                                                $sort_category, ['class' => 'selectpicker show-tick text-left', 'data-style' => 'btn-submit-delete btn-submit-full btn-padded', 'title' => 'Vrsta sortiranja...', 'data-size' => '5'])
                                        }}
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-group">
                                        {{ Form::label('news_text_sort', 'Pretraga po naslovu vijesti:') }}
                                        {{ Form::text('news_text_sort', $news_text_sort, ['id' => 'news_text', 'class' => 'form-control form-control-inverse', 'placeholder' => 'Naslov vijesti...']) }}
                                    </div>
                                </div>
                            {{ Form::close() }}

                            <div class="col-md-12">
                                <hr>
                            </div>
                        </div>

                        @if(count($news_data->all()) > 0)
                            @foreach(array_chunk($news_data->all(), 3) as $news)
                                <div class="row padded">
                                    @foreach($news as $item)
                                        <a href="{{ route('news-show', $item->slug) }}" class="news-block">
                                            <div class="col-md-4 news-all-content" id="news-{{ $item->id }}">
                                                <div class="news-all-header">
                                                    <h3 class="news-all-header-title text-center">{{ $item->news_title }}</h3>
                                                    @if($item->images->count() > 0)
                                                        {{ HTML::image('/'.getenv('NEWS_UPLOAD_DIR').'/'.$item->id.'/'.$item->images->first()->file_name, imageAlt($item->images->first()->file_name), ['class' => 'thumbnail img-responsive lazy']) }}
                                                    @else
                                                        {{ HTML::image(URL::to('https://via.placeholder.com/500x500?text=Nema slike'), 'Nema slike', ['class' => 'thumbnail img-responsive']) }}
                                                    @endif
                                                </div> <!-- end news-all-header -->
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            @endforeach

                            <div class="pagination-layout pagination-centered">
                                {{ $news_data->appends(Request::except('stranica'))->links() }}
                            </div> <!-- end pagination -->
                        @else
                            @if($news_text_sort)
                                <div class="text-center">
                                    <h3>Trenutno nema vijesti s tim naslovom.</h3>
                                </div>
                            @else
                                <div class="text-center">
                                    <h3>Trenutno nema vijesti.</h3>
                                </div>
                            @endif
                        @endif

                        <p class="text-center space">
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