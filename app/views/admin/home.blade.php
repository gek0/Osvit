@include('admin.layout.header')

<div class="row">
    <div class="col-lg-8 col-lg-offset-2" id="layout-block-main">
        <ul class="nav nav-pills custom-pills">
            <li class="active"><a data-toggle="pill" href="#cover-image">Naslovnica <i class="fa fa-camera"></i></a></li>
            <li><a data-toggle="pill" href="#features">Ukratko <i class="fa fa-pencil"></i></a></li>
        </ul>
        <hr>

        <!-- start tab-content -->
        <div class="tab-content">
            <div id="cover-image" class="tab-pane fade in active">
                {{ Form::open(['url' => route('admin-cover-editPOST'), 'role' => 'form', 'id' => 'admin-info', 'files' => true, 'class' => 'form-element']) }}
                    <div class="form-group">
                            {{ Form::label('cover_title', 'Naslov:') }}
                            {{ Form::text('cover_title', $cover_data['cover_title'], ['class' => 'form-input-control', 'placeholder' => 'Naslov']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('cover_subtitle', 'Podnaslov:') }}
                        {{ Form::text('cover_subtitle', $cover_data['cover_subtitle'], ['class' => 'form-input-control', 'placeholder' => 'Podnaslov']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('cover_image', 'Postavi sliku naslovnice (briše postojeću):') }}
                        {{ Form::file('cover_image', ['class' => 'file', 'data-show-upload' => false, 'data-show-caption' => true, 'id' => 'cover_image', 'accept' => 'image/*']) }}
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-submit btn-submit-full">Spremi izmjene <i class="fa fa-check"></i></button>
                    </div>
                {{ Form::close() }}

                <div class="text-center space">
                    <h3>Trenutna slika:</h3>
                    @if($cover_data['cover_file_size'] > 0)
                        {{HTML::image('/cover_uploads/'.$cover_data['cover_file_name'], getenv('WEB_NAME'), ['title' => $cover_data['cover_file_name'], 'class' => 'img-thumbnail img-responsive'])}}

                        <hr>
                        <a href="{{ route('admin-cover-image-delete') }}" class="space">
                            <button class="btn btn-submit-delete">
                                Obriši <i class="fa fa-trash"></i>
                            </button>
                        </a>
                    @else
                        <p>Trenutno <strong>nema</strong> dodane slike pa je postavljena inicijalna.</p>
                        {{HTML::image($cover_data['cover_file_name'], getenv('WEB_NAME'), ['title' => getenv('WEB_NAME'), 'class' => 'img-thumbnail img-responsive'])}}
                    @endif
                </div>
            </div>
            <div id="features" class="tab-pane fade">
                ukratko
            </div>
        </div>
        <!-- end tab-content -->
    </div>
</div>

<script>
    jQuery(document).ready(function(){
        /**
         * delete  confirmation
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
                            'Nije obrisano :)',
                            'error'
                    )
                }
            })
        });
    });
</script>

@include('admin.layout.footer')