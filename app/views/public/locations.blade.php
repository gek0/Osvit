<section id="osvit-locations" data-section="locations">
    <div class="container">
        <div class="row">
            <div class="col-md-12 section-heading text-center">
                <h2 class="to-animate">Lokacije naših dvorana</h2>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 subtext to-animate">
                        <h3>Pronađite koja Vam najviše odgovara.</h3>
                        <h5><span class="red">*</span> Ako karta nije vidljiva ponovo učitajte stranicu.</h5>
                    </div>
                </div>
            </div>
        </div>
        @if($locations_data->count() > 0)
            <div class="row">
                <div class="col-md-4" id="location-details">
                    @foreach($locations_data as $location)
                        <h3 class="text-center">{{ $location->map_title }}</h3>
                        <h4 class="text-center"><i class="fa fa-phone" aria-hidden="true" title="Kontakt"></i>
                            {{ $location->contact_info }}
                        </h4>                        
                        <h3 class="text-center">Raspored dvorane</h3>
                        {{ removeEmptyP(nl2p((new BBCParser)->parse($location->time_schedule))) }}
                        <hr>
                    @endforeach
                </div>

                <div class="col-md-8">
                    <div class="map-container space">
                        <!-- start map section -->
                        <section id="map">
                            <noscript>
                                Morate imati omogućen JavaScript u Vašem internet pregledniku kako bi se prikazala mapa, hvala na razumijevanju.
                            </noscript>
                        </section>
                        <!-- end map section -->
                    </div>
                </div>            
            </div>
        @else
            <h2 class="text-center">Još ih nismo objavili, dođite uskoro.</h2>
        @endif
    </div>
</section>

<script type='text/javascript' src='{{ route('generate-js-map-multiple-pins') }}'></script>
