<hr>
<section id="osvit-news" data-section="news">
    <div class="osvit-overlay"></div>
    <div class="container">
        <div class="row">
            @if($news_data)
            <div class="col-md-12 section-heading section-heading-tiny-pad text-center to-animate">
                <h2>Obavijesti</h2>
                <h3>{{ $news_data->news_title }}</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <blockquote>
                    {{ Str::limit(removeEmptyP(nl2p((new BBCParser)->parse($news_data->news_body))), 750) }}

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
                </blockquote>

                <div class="space"></div>
                <div class="div-small">
                    <a href="{{ route('news') }}">
                        <button class="btn btn-submit-delete btn-submit-full">
                            <i class="fa fa-newspaper-o" aria-hidden="true"></i> Prikaži sve obavijesti
                        </button>
                    </a>
                </div>
                <div class="space"></div>
            </div>
        </div>
            @else
            <div class="col-md-12 section-heading text-center to-animate">
                <h2>Obavijesti</h2>
                <h3 class="text-center">Još ih nismo objavili, dođite uskoro.</h3>
            @endif
    </div>
</section>