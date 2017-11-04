<section id="osvit-intro">
    <div class="container">
        <div class="row space">
            @foreach($feature_data as $feature)
                @if($feature->feature_title)
                    <div class="osvit-block to-animate">
                        <div class="overlay-darker"></div>
                        <div class="overlay"></div>
                        <div class="osvit-text">
                            <i class="feature-icon {{ $feature->feature_icon }}"></i>
                            <h2>{{ $feature->feature_title }}</h2>
                            <p>{{ $feature->feature_body }}</p>
                            <p>
                                <a href="#" data-nav-section="{{ $feature->feature_link }}" class="btn btn-sm animated-button victoria-two feature-menu-anchor">
                                    <i class="fa fa-angle-down fa-big fa-into-black" aria-hidden="true"></i>
                                </a>
                            </p>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        @if($video_gallery_data)
            <div class="row watch-video text-center to-animate space">
                <span>Pogledajte video</span>

                <a href="{{ $video_gallery_data['video_url'] }}&fs=1&wmode=opaque" class="popup-vimeo btn-video"><i class="icon-play2 pulseAnim"></i></a>
            </div>
        @endif
    </div>
</section>