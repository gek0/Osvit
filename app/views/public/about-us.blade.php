<section id="osvit-about" data-section="about">
    <div class="osvit-overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 section-heading text-center">
                <h2 class="to-animate">O nama</h2>
                @if($about_us_data['about_title'] && $about_us_data['about_body'])
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 subtext to-animate">
                            <h3>{{ $about_us_data['about_title'] }}</h3>
                        </div>

                        <div class="col-md-12">
                            <div class="text-center to-animate">
                                <blockquote>
                                    {{ removeEmptyP(nl2p((new BBCParser)->parse($about_us_data['about_body']))) }}
                                </blockquote>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 subtext to-animate">
                            <h3>Još uvijek nismo dodali sadržaj...</h3>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>