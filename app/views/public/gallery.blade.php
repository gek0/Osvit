<section id="osvit-gallery" data-section="gallery">
    <div class="container">
        <div class="row">
            <div class="col-md-12 section-heading text-center">
                <h2 class="to-animate">Galerija slika</h2>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 subtext to-animate">
                        <h3>Jedna slika govori više nego tisuću riječi.</h3>
                    </div>
                </div>
            </div>
        </div>

        @include('public.gallery-shared-output')

        <p class="text-center">
            <a href="{{ route('image-gallery') }}" class="btn btn-sm animated-button victoria-two">
                <i class="fa fa-camera" aria-hidden="true"></i> Prikaži sve slike
            </a>
        </p>
    </div>
</section>