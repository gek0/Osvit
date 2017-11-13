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

<!-- content directives start -->
@if($previous_news)
    <div class="previousContent">
        <a href="{{ URL::to(route('news-show', $previous_news['slug'])) }}" title="{{ $previous_news['news_title'] }}">
            <i class="fa fa-angle-left fa-gig"></i>
        </a>
    </div>
@endif
@if($next_news)
    <div class="nextContent">
        <a href="{{ URL::to(route('news-show', $next_news['slug'])) }}" title="{{ $next_news['news_title'] }}">
            <i class="fa fa-angle-right fa-gig"></i>
        </a>
    </div>
@endif
<!-- content directives end -->

<section id="osvit-gallery">
    <div class="container to-animate">
        <div class="row">
            <div class="col-md-12 section-heading">
                <h2 class="text-center">{{ $news_data->news_title }}</h2>
                <div class="row">
                    <div class="col-md-3 space">
                        <span class="fa fa-calendar fa-med" title="Objavljeno"></span>
                        <span class="info-text">
                            <time datetime="{{ $news_data->getDateCreatedFormatedHTML() }}"><strong>{{ $news_data->getDateCreatedFormated() }}</strong></time>
                        </span>
                    </div>
                    <div class="col-md-9 space">
                        <span class="fa fa-eye fa-med" title="Broj pregleda"></span>
                        <span class="info-text"><strong>{{ $news_data->num_visited }}</strong></span>
                    </div>

                    <div class="col-md-12 space">
                        {{ removeEmptyP(nl2p((new BBCParser)->parse($news_data->news_body))) }}

                        @if($news_data->tags->count() > 0)
                            <div class="space"></div>
                            <div class="text-center tags-collection">
                                <ul class="tags">
                                    @foreach($news_data->tags as $tag)
                                        <a href="{{ route('news-tag', $tag->slug) }}"><li>{{ $tag->tag }}</li></a>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="space"></div>
                        @endif
                        <hr>
                    </div>
                </div>

                @if($news_data->images->count() > 0)
                    <section id="image_gallery" class="space">
                        <div class="row row-bottom-padded-sm" id="image-gallery-content">
                            <?php $i = 0; ?>
                            @foreach($news_data->images as $img)
                                <?php
                                    if(($i > 0) && ($i % 3 == 0)) {
                                ?>
                                    <div class="clearfix visible-sm-block"></div>
                                <?php
                                    }
                                    ++$i;
                                ?>

                                <div class="col-md-4 col-sm-6 col-xxs-12 img-identical">
                                    <a href="{{ URL::to('/'.getenv('NEWS_UPLOAD_DIR').'/'.$news_data->id.'/'.$img->file_name) }}" class="osvit-project-item image-popup to-animate">
                                        <img src="{{ URL::to('/'.getenv('NEWS_UPLOAD_DIR').'/'.$news_data->id.'/'.$img->file_name) }}" alt="{{ imageAlt($img->file_name) }}" class="img-responsive img-gallery-identical lazy">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </section>
                @else
                    <section id="image_gallery" class="space text-center">
                        <h3>Obavijest nema slika.</h3>
                    </section>
                @endif

                <p class="text-center space">
                    <a href="{{ route('news') }}" class="btn btn-sm animated-button victoria-two">
                        <i class="fa fa-newspaper-o" aria-hidden="true"></i> Povratak na obavijesti
                    </a>
                    <a href="{{ route('home') }}" class="btn btn-sm animated-button victoria-two">
                        <i class="fa fa-home" aria-hidden="true"></i> Povratak na naslovnicu
                    </a>
                </p>

            </div>
        </div>
    </div>
</section>

@include('public.layout.footer')