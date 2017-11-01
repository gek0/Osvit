@if($cover_data['cover_file_size'] > 0)
    <section id="fh5co-home" data-section="home" style="background-image: url('{{ url('/cover_uploads/'.$cover_data['cover_file_name']) }}');" data-stellar-background-ratio="0.5">
@else
    <section id="fh5co-home" data-section="home" style="background-image: url('{{ $cover_data['cover_file_name'] }}');" data-stellar-background-ratio="0.5">
@endif
        <div class="container">
            <div class="text-wrap">
                <div class="text-inner">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            @if($cover_data['cover_title'])
                                <h1 class="to-animate">{{ $cover_data['cover_title'] }}</h1>
                            @endif
                            @if($cover_data['cover_subtitle'])
                                <h2 class="to-animate">{{ $cover_data['cover_subtitle'] }}</h2>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="slant"></div>
    </section>