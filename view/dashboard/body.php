<!doctype html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Bot Metas -->
    <meta name="robots" content="noindex, nofollow" />
    <meta name="AdsBot-Google" content="noindex, nofollow" />
    <meta name="googlebot" content="noindex, nofollow" />
    <meta name="googlebot-news" content="noindex, nofollow" />

    <!-- Author -->
    <meta name="author" content="Doğukan ALYANAK">
    <title>Yönetim Paneli | OTTO PHOTO APP v2.0</title>

    <!-- jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>

    <!---Bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!---Fontawesome v6.2.0 css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="plugin/fontawesome/6.2.0/css/all.min.css" />

    <!-- dropzone -->
    <link rel="stylesheet" href="plugin/dropzone/6-0-0-beta-1/dropzone.css">

    <link rel="stylesheet" href="plugin/eastalert/v1.0.0/eastalert.css">
    <link rel="stylesheet" href="view/dashboard/style.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="row">
                    <div class="col text-center mt-4 mb-2">
                        <img style="width: 250px;" src="img/logo.svg" alt="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h1 class="text-center">Yükleme Alanı</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
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
                </div>


            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="row">
                    <div class="col-12  mt-4">
                        <h1>İşleniyor ...</h1>
                    </div>
                    <div class="col-12">
                        <div class="row" id="waitImageLibrary">

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12  mt-4">
                        <h1>Tamamlanan Fotoğraflar</h1>
                    </div>
                    <div class="col-12">
                        <button type="button" id="removeAllBtn" class="btn btn-block bt-md btn-danger"> Tümünü Sil </button>
                    </div>
                    <div class="col-12 mt-4">
                        <div class="row" id="imageLibrary">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- remove all modal -->
    <div class="modal fade bd-example-modal-lg" id="removeAllModal" tabindex="-1" role="dialog" aria-labelledby="removeAllModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Tüm fotoğrafları silmek istediğinize emin misiniz ?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <h4>Bu işlem geri alınamaz! Yüklü Tüm Fotoğrafları silmek istediğinize emin misiniz ?</h4>
                    </div>
                    <div class="row pt-2 text-right" style="display: block;">
                        <button type="button" style="width: 150px;" class="btn btn-danger" id="lastDeleteAllRemoveBtn">Evet</button>
                        <button type="button" style="width: 150px;" class="btn btn-dark" data-dismiss="modal" aria-label="Close">Hayır</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /remove all modal -->
    <!-- remove image modal -->
    <div class="modal fade bd-example-modal-lg" id="removeModal" tabindex="-1" role="dialog" aria-labelledby="removeModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Bu fotoğrafı silmek istediğinize emin misiniz ?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
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