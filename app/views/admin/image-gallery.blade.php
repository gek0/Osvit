@include('admin.layout.header')

<div class="row">
    <div class="col-lg-8 col-lg-offset-2" id="layout-block-main">
        {{ Form::open(['url' => 'admin/galerija', 'role' => 'form', 'id' => 'admin-image-gallery', 'files' => true, 'class' => 'form-element']) }}
        <div class="form-group">
            {{ Form::label('image_gallery_images', 'Dodaj slike na stranicu:') }}
            {{ Form::file('image_gallery_images[]', ['multiple' => true, 'class' => 'file', 'data-show-upload' => false, 'data-show-caption' => true, 'id' => 'image_gallery_images', 'accept' => 'image/*', 'required' => 'true']) }}
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-submit btn-submit-full">Spremi izmjene <i class="fa fa-check"></i></button>
        </div>
        {{ Form::close() }}

        @if($image_gallery_data->count() > 0)
            <hr>
            <section id="image_gallery">
                <div class="container-fluid">
                    <div class="row padded text-center">
                        <h2>Galerija slika  <small id="image_gallery_counter">{{ $image_gallery_data->count() }}</small></h2>
                        @foreach($image_gallery_data as $img)
                            <div class="col-lg-4 col-sm-4 col-6 small-marg" id="img-container-{{ $img->id }}">
                                <a href="{{ URL::to('/image_gallery_uploads/'.$img->file_name) }}" data-imagelightbox="gallery-images">
                                    <img data-original="{{ URL::to('/image_gallery_uploads/'.$img->file_name) }}" alt="{{ imageAlt($img->file_name) }}" class="thumbnail img-responsive lazy" />
                                </a>
                                <a href="{{ route('admin-image-gallery-image-delete', $img->id) }}">
                                    <button id="{{ $img->id }}" class="btn btn-submit-delete" title="Brisanje slike {{ $img->file_name }}">
                                        Obriši <i class="fa fa-trash"></i>
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

<script>
    jQuery(document).ready(function(){
        /**
         * delete gallery image confirmation
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
                            'Slika je sigurna od brisanja :)',
                            'error'
                    )
                }
            })
        });
    });
</script>

@include('admin.layout.footer')