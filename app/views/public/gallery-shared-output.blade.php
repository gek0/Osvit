<div class="row row-bottom-padded-sm" id="image-gallery-content">
    <?php $i = 0; ?>
    @foreach($image_gallery_data as $img)
        <?php
        if(($i > 0) && ($i % 3 == 0)) {
        ?>
        <div class="clearfix visible-sm-block"></div>
        <?php
        }
        ++$i;
        ?>

        <div class="col-md-4 col-sm-6 col-xxs-12 img-identical">
            <a href="{{ URL::to('/'.getenv('IMAGE_GALLERY_UPLOAD_DIR').'/'.$img->file_name) }}" class="osvit-project-item image-popup to-animate">
                <img src="{{ URL::to('/'.getenv('IMAGE_GALLERY_UPLOAD_DIR').'/'.$img->file_name) }}" alt="{{ imageAlt($img->file_name) }}" class="img-responsive img-gallery-identical lazy">
            </a>
        </div>
    @endforeach
</div>