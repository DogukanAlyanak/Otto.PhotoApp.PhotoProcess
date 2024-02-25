<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Bot Metas -->
    <meta name="robots" content="noindex, nofollow" />
    <meta name="AdsBot-Google" content="noindex, nofollow" />
    <meta name="googlebot" content="noindex, nofollow" />
    <meta name="googlebot-news" content="noindex, nofollow" />

    <!-- Author -->
    <meta name="author" content="Doğukan ALYANAK">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Yönetim Paneli | OTTO PHOTO APP v2.0</title>

    <!-- dropzone -->
    <link rel="stylesheet" href="plugin/dropzone/6-0-0-beta-1/dropzone.css">

    <!---Fontawesome v6.2.0 css -->
    <link rel="stylesheet" href="plugin/fontawesome/6.2.0/css/all.min.css" />

    <link rel="stylesheet" href="plugin/eastalert/v1.0.0/eastalert.css">
    <link rel="stylesheet" href="view/dashboard/style.css">
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 text-center">
                <h1>Yükleme Alanı</h1>
            </div>

            <!-- DROPZONE -->
            <div class="row dz-preview">
                <form id="imageUploadDropzone" class="dropzone" enctype="multipart/form-data" method="post">
                    <div class="dz-message" data-dz-message>
                        <span>
                            Lütfen buraya eklemek istediğiniz fotoğrafları yükleyin.
                        </span>
                    </div>
                </form>
            </div>
            <!-- /DROPZONE -->

        </div>
        <div class="row mt-3">
            <div class="col-12 text-center">
                <h1>İşlemeyi Bekleyen Fotoğraflar</h1>
            </div>
            <div class="col-12">
                <div class="row" id="waitImageLibrary">

                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 text-center">
                <h1>İşlenen Fotoğraflar</h1>
            </div>
            <div class="col-12">
                <div class="row" id="imageLibrary">

                </div>
            </div>
        </div>
    </div>

    <!-- remove image modal -->
    <div class="modal fade bd-example-modal-lg" id="removeModal" tabindex="-1" role="dialog" aria-labelledby="removeModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Bu fotoğrafı silmek istediğinize emin misiniz ?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <img filename="" class="remove-modal-img" src="">
                    </div>
                    <div class="row pt-2 text-right" style="display: block;">
                        <button type="button" style="width: 150px;" class="btn btn-danger" id="lastDeleteBtn">Evet</button>
                        <button type="button" style="width: 150px;" class="btn btn-dark" data-dismiss="modal" aria-label="Close">Hayır</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /remove image modal -->

    <!-- easta alert -->
    <div class="east-fixed-alert">
        <div class="container">
            <div class="row">
                <div class="offset-lg-3 col-lg-6 offset-ml-2 col-ml-8 col-sm-12">
                    <div class="ertalert">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- easta alert -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>

    <!-- dropzone -->
    <script src="plugin/dropzone/6-0-0-beta-1/dropzone-min.js"></script>

    <!---Fontawesome v6.2.0 css -->
    <script src="plugin/fontawesome/6.2.0/js/pro.min.js"></script>

    <script src="view/dashboard/script.js"></script>
    <script src="view/dashboard/upload_photos.js"></script>
    <script src="view/dashboard/get_images.js"></script>
    <script src="view/dashboard/remove_image.js"></script>
    <script src="plugin/eastalert/v1.0.0/eastalert.js"></script>
</body>

</html>