@include('admin.layout.header')

<div class="row">
    <div class="col-lg-8 col-lg-offset-2" id="layout-block-main">
        <ul class="nav nav-pills custom-pills">
            <li class="active"><a data-toggle="pill" href="#cover-image">Naslovnica <i class="fa fa-camera"></i></a></li>
            <li><a data-toggle="pill" href="#features">Ukratko <i class="fa fa-pencil"></i></a></li>
            <li><a data-toggle="pill" href="#fun-facts">Info brojevi <i class="fa fa-pencil"></i></a></li>
        </ul>
        <hr>

        <!-- start tab-content -->
        <div class="tab-content">
            @include('admin.home.cover-image')

            @include('admin.home.features')

            @include('admin.home.fun-facts')
        </div>
        <!-- end tab-content -->
    </div>
</div>

<script>
    jQuery(document).ready(function(){
        /**
         * delete confirmation
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