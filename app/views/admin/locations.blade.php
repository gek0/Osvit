@include('admin.layout.header')

<div class="row">
    <div class="col-lg-8 col-lg-offset-2" id="layout-block-main">
        {{ Form::open(['url' => route('admin-locationsPOST'), 'role' => 'form', 'id' => 'admin-locations', 'files' => true, 'class' => 'form-element']) }}

            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('map_title', 'Naziv dvorane') }}
                    {{ Form::text('map_title', null, ['class' => 'form-input-control', 'placeholder' => 'Naziv dvorane', 'id' => 'map_title', 'required' => 'true']) }}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('contact_info', 'Kontakt informacije') }}
                    {{ Form::text('contact_info', null, ['class' => 'form-input-control', 'placeholder' => 'Kontakt informacije', 'id' => 'contact_info', 'required' => 'true']) }}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('map_lat', 'Zemljopisna širina (latitude)') }}
                    {{ Form::text('map_lat', null, ['class' => 'form-input-control', 'placeholder' => 'Zemljopisna širina (latitude) npr. 43.172362', 'id' => 'map_lat', 'required' => 'true']) }}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('map_lng', 'Zemljopisna dužina (longitude)') }}
                    {{ Form::text('map_lng', null, ['class' => 'form-input-control', 'placeholder' => 'Zemljopisna dužina (longitude), npr. 16.4408177', 'id' => 'map_lng', 'required' => 'true']) }}
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('time_schedule', 'Raspored dvorane') }}
                    {{ Form::textarea('time_schedule', null, ['class' => 'form-input-control', 'placeholder' => 'Raspored dvorane', 'id' => 'codeEditor', 'required' => 'true']) }}
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group admin-video-help">
                    <div class="space text-center">
                        <h4><strong>NEOBAVEZNO:</strong> Za odabir drugih dizajnova, kopirati i minimizirati JSON (inače se koristi inicijalni dizajn)</h4>
                        <a href="https://snazzymaps.com/" target="_blank" class="btn btn-primary">
                            <i class="fa fa-search fa-med"></i> Mape
                        </a>
                        <a href="https://www.cleancss.com/json-minify/" target="_blank" class="btn btn-primary">
                            <i class="fa fa-search fa-med"></i> Minimizacija JSON-a
                        </a>
                    </div>

                    {{ Form::textarea('map_style', null, ['class' => 'form-input-control', 'placeholder' => 'JSON dizajna mape', 'id' => 'map_style']) }}
                </div>
            </div>
            <div class="col-md-12">
                <div class="checkbox checkbox-primary">
                <span class="button-checkbox">
                    <button type="button" class="btn" data-color="danger" id="toggle-admin-video-help"> Vlastiti dizajn mape</button>
                    <input type="checkbox" class="hidden" autocomplete="off" id="remember_me" name="remember_me" value="1">
                </span>
                </div>
            </div>

            <hr>
            <div class="space text-center">
                <button type="submit" class="btn btn-submit btn-submit-full">Spremi izmjene <i class="fa fa-check"></i></button>
            </div>
        {{ Form::close() }}

        @if($locations_data->count() > 0)
            <hr>
            <section id="image_gallery">
                <div class="container-fluid">
                    <div class="row padded text-center">
                    <h2>Dvorane  <small id="locations_counter">{{ $locations_data->count() }}</small></h2>

                        @foreach($locations_data as $location)
                            <div class="well">
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

                                <a href="{{ route('admin-locations-delete', $location->id) }}">
                                    <button id="{{ $location->id }}" class="btn btn-submit-delete" title="Brisanje dvorane '{{ $location->map_title }}'">
                                        Obriši <i class="fa fa-trash"></i>
                                    </button>
                                </a>
                                <a href="{{ route('admin-locations-edit', $location->id) }}">
                                    <button id="{{ $location->id }}" class="btn btn-submit-edit" title="Izmjena dvorane '{{ $location->map_title }}'">
                                        Izmjeni <i class="fa fa-pencil"></i>
                                    </button>
                                </a>
                            </div>
                            <div class="clearfix visible-xs"></div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    </div>
</div>

@foreach($locations_data as $location)
    <script type='text/javascript' src='{{ route('generate-js-map', $location->id) }}'></script>
@endforeach

<script>
    jQuery(document).ready(function(){
        /**
         * delete location confirmation
         */
        $(".btn-submit-delete").click(function(event){
            event.preventDefault();
            var delete_url_redirect = $(this).parent().attr("href");

            swal({
                title: 'Sigurno to želiš?',
                text: 'Ova radnja je nepovratna.',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Da',
                cancelButtonText: 'Ne, odustani!',
                confirmButtonClass: 'btn btn-padded-smaller btn-submit-edit',
                cancelButtonClass: 'btn btn-padded-smaller btn-submit-delete',
                buttonsStyling: true
            }).then(function () {
                window.location.href = delete_url_redirect;
            }, function (dismiss) {
                if (dismiss === 'cancel') {
                    swal(
                            'Odustanak',
                            'Dvorana je sigurna od brisanja :)',
                            'error'
                    )
                }
            })
        });
    });
</script>

@include('admin.layout.footer')