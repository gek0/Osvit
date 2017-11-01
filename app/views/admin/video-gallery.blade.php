@include('admin.layout.header')

<div class="row">
    <div class="col-lg-8 col-lg-offset-2" id="layout-block-main">
        <div class="admin-video-help marginated-center">
            {{ HTML::image('css/assets/images/link_to_embedd.png', 'Link za embedd videa', ['class' => 'img-responsive']) }}
        </div>
        <button class="btn btn-submit btn-padded" id="toggle-admin-video-help"><i class="fa fa-info fa-med"></i> Upute za video URL</button></a>


        {{ Form::open(['url' => route('admin-video-galleryPOST'), 'role' => 'form', 'id' => 'admin-video-gallery', 'class' => 'form-element']) }}
        <div class="form-group">
            {{ Form::label('video_url', 'Video URL:') }}
            {{ Form::text('video_url', '', ['class' => 'form-input-control', 'placeholder' => 'Video URL (YouTube, Vimeo, ...)', 'id' => 'video_url', 'required' => 'true']) }}
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-submit btn-submit-full">Spremi izmjene <i class="fa fa-check"></i></button>
        </div>
        {{ Form::close() }}

        @if($video_gallery_data)
            <hr>
            <section id="video_gallery">
                <div class="container-fluid">
                    <div class="row padded text-center">
                        <h2>Video za prezentaciju:</h2>
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe width="650" height="400" src="{{ $video_gallery_data['video_url'] }}&fs=1&wmode=opaque" frameborder="0" allowfullscreen></iframe>
                        </div>

                        <hr>
                        <a href="{{ route('admin-video-gallery-delete') }}" class="space">
                            <button class="btn btn-submit-delete">
                                Obriši <i class="fa fa-trash"></i>
                            </button>
                        </a>
                    </div>
                </div>
            </section>
        @else
            <section id="video_gallery">
                <div class="container-fluid">
                    <div class="row padded text-center">
                        <p>Trenutno <strong>nije</strong> postavljen video za prezentaciju.</p>
                    </div>
                </div>
            </section>
        @endif
    </div>
</div>

<script>
    jQuery(document).ready(function(){
        /**
         * delete gallery video confirmation
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
                            'Video je siguran od brisanja :)',
                            'error'
                    )
                }
            })
        });
    });
</script>

@include('admin.layout.footer')