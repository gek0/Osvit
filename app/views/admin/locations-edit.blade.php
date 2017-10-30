@include('admin.layout.header')

<div class="row">
    <div class="col-lg-8 col-lg-offset-2" id="layout-block-main">
        {{ Form::open(['url' => 'admin/dvorane-izmjena', 'role' => 'form', 'id' => 'admin-locations', 'files' => true, 'class' => 'form-element']) }}

            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('map_title', 'Naziv dvorane') }}
                    {{ Form::text('map_title', $location->map_title, ['class' => 'form-input-control', 'placeholder' => 'Naziv dvorane', 'id' => 'map_title', 'required' => 'true']) }}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('contact_info', 'Kontakt informacije') }}
                    {{ Form::text('contact_info', $location->contact_info, ['class' => 'form-input-control', 'placeholder' => 'Kontakt informacije', 'id' => 'contact_info', 'required' => 'true']) }}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('map_lat', 'Zemljopisna širina (latitude)') }}
                    {{ Form::text('map_lat', $location->map_lat, ['class' => 'form-input-control', 'placeholder' => 'Zemljopisna širina (latitude) npr. 43.172362', 'id' => 'map_lat', 'required' => 'true']) }}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('map_lng', 'Zemljopisna dužina (longitude)') }}
                    {{ Form::text('map_lng', $location->map_lng, ['class' => 'form-input-control', 'placeholder' => 'Zemljopisna dužina (longitude), npr. 16.4408177', 'id' => 'map_lng', 'required' => 'true']) }}
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('time_schedule', 'Raspored dvorane') }}
                    {{ Form::textarea('time_schedule', $location->time_schedule, ['class' => 'form-input-control', 'placeholder' => 'Raspored dvorane', 'id' => 'codeEditor', 'required' => 'true']) }}
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group admin-video-help" style="{{ $custom_style ? 'display: block;' : 'display: none;' }}">
                    <div class="space text-center">
                        <h4><strong>NEOBAVEZNO:</strong> Za odabir drugih dizajnova, kopirati i minimizirati JSON (inače se koristi inicijalni dizajn)</h4>
                        <a href="https://snazzymaps.com/" target="_blank" class="btn btn-primary">
                            <i class="fa fa-search fa-med"></i> Mape
                        </a>
                        <a href="https://www.cleancss.com/json-minify/" target="_blank" class="btn btn-primary">
                            <i class="fa fa-search fa-med"></i> Minimizacija JSON-a
                        </a>
                    </div>

                    {{ Form::textarea('map_style', $location->map_style, ['class' => 'form-input-control', 'placeholder' => 'JSON dizajna mape', 'id' => 'map_style',]) }}
                </div>
            </div>
            <div class="col-md-12">
                <div class="checkbox checkbox-primary">
                <span class="button-checkbox">
                    <button type="button" class="btn" data-color="danger" id="toggle-admin-video-help"> Vlastiti dizajn mape</button>
                    <input type="checkbox" class="hidden" autocomplete="off" id="remember_me" name="remember_me" checked="{{ $custom_style }}" value="1">
                </span>
                </div>
            </div>

            <hr>
            <div class="space text-center">
                {{ Form::hidden('id', $location->id) }}
                <button type="submit" class="btn btn-submit btn-submit-full">Spremi izmjene <i class="fa fa-check"></i></button>
            </div>
        {{ Form::close() }}

        <div class="row padded text-center">
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
            </div>
        </div>

        <hr>
        <div class="space text-left">
            <a href="{{ URL::route('admin-locations') }}">
                <button class="btn btn-submit">Povratak na listu <i class="fa fa-home"></i></button>
            </a>
        </div>
    </div>
</div>

<script type='text/javascript' src='{{ route('generate-js-map', $location->id) }}'></script>

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