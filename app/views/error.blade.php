@include('public.layout.header')

<div class="container content-holder">
    <section class="logo-placeholder">
        <h1>Dogodila se greška</h1>
    </section>

    <section class="section section-inner">
        <div class="text-center space">
            <h2>{{{ $exception }}}</h2>

            <div class="space"></div>
            <a href="{{ URL::route('home') }}"><button class="learn-btn-inverse animated fadeInUp">Povratak na početnu <i class="fa fa-home fa-med"></i></button></a>
        </div>
    </section> <!-- end section-inner -->

    </section> <!-- end #main -->

@include('public.layout.footer')