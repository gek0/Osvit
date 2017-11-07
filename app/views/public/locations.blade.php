<section id="osvit-locations" data-section="locations">
    <div class="container">
        <div class="row">
            <div class="col-md-12 section-heading text-center">
                <h2 class="to-animate">Lokacije naših dvorana</h2>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 subtext to-animate">
                        <h3>Pronađite koja Vam najviše odgovara.</h3>
                    </div>
                </div>
            </div>
        </div>
        @if($locations_data->count() > 0)
            @foreach($locations_data as $location)
                <h3>{{ $location->map_title }}</h3>
                <div class="map-container space">
                <!-- start map section -->
                    <section id="map{{ $location->id }}">
                        <noscript>
                            Morate imati omogućen JavaScript u Vašem internet pregledniku kako bi se prikazala mapa, hvala na razumijevanju.
                        </noscript>
                    </section>
                <!-- end map section -->
                </div>

                <div class="clearfix visible-xs"></div>
            @endforeach
        @else
            <h2 class="text-center">Još ih nismo objavili, dođite uskoro.</h2>
        @endif
    </div>
</section>

@foreach($locations_data as $location)
    <script type='text/javascript' src='{{ route('generate-js-map', $location->id) }}'></script>
@endforeach