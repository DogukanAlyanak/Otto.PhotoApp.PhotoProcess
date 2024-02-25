<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Giriş | OTTO PHOTO APP v2.0</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bot Metas -->
    <meta name="robots" content="noindex, nofollow" />
    <meta name="AdsBot-Google" content="noindex, nofollow" />
    <meta name="googlebot" content="noindex, nofollow" />
    <meta name="googlebot-news" content="noindex, nofollow" />

    <!-- Author -->
    <meta name="author" content="Doğukan ALYANAK">

    <link rel="stylesheet" href="font/iconsmind/style.css" />
    <link rel="stylesheet" href="font/simple-line-icons/css/simple-line-icons.css" />

    <link rel="stylesheet" href="css/vendor/bootstrap.min.css" />
    <link rel="stylesheet" href="css/vendor/bootstrap-float-label.min.css" />
    <link rel="stylesheet" href="css/main.css" />
</head>

<body class="background show-spinner">
    <div class="fixed-background"></div>
    <main>
        <div class="container">
            <div class="row h-100">
                <div class="col-12 col-md-10 mx-auto my-auto">
                    <div class="card auth-card">
                        <div class="position-relative image-side ">

                            <p class=" text-white h2">OTTO PHOTO APP v2.0</p>

                            <p class="white mb-0">
                            </p>
                        </div>
                        <div class="form-side">
                            <a href="#">
                                <span class="logo-single" style="width: 200px;"></span>
                            </a>
                            <h6 class="mb-4">Giriş</h6>
                            <form id="loginForm">
                                <label class="form-group has-float-label mb-4">
                                    <input id="username" class="form-control" placeholder="username" />
                                    <span>Kullanıcı Adı</span>
                                </label>

                                <label class="form-group has-float-label mb-4">
                                    <input class="form-control" type="password" id="password" placeholder="***" />
                                    <span>Şifre</span>
                                </label>
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="#"></a>
                                    <button class="btn btn-primary btn-lg btn-shadow" type="submit">Giriş Yap</button>
                                </div>
                                <div id="errorDiv"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="js/vendor/jquery-3.3.1.min.js"></script>
    <script src="js/vendor/bootstrap.bundle.min.js"></script>
    <script src="js/dore.script.js"></script>
    <script src="js/scripts.js"></script>
    <script src="view/login/script.js"></script>
</body>

</html>