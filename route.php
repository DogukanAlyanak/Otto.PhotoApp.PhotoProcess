<?php

$extension = $_SERVER['REQUEST_URI'];
$ext = @explode('/', substr($extension, 1));

if ($ext[0] == "test") {
    include $root . '/test.php';
    exit;
}

if ($ext[0] == "get_photo_process") {
    include $root . '/get_photo_process.php';
    exit;
}



// CONTROLLER PANEL

if ($ext[0] == "admin") {
    redirect("login");
    exit;
}

if ($ext[0] == "logout") {
    session_destroy();
    redirect("login");
    exit;
}

if ($ext[0] == "login") {
    include $root . '/view/login/page.php';
    exit;
}

if ($ext[0] == "login_process") {
    include $root . '/view/login/login_process.php';
    exit;
}




if ($ext[0] == "dashboard") {
    include $root . '/view/dashboard/page.php';
    exit;
}

if ($ext[0] == "dashboard_upload_image_process") {
    include $root . '/view/dashboard/image_upload_process.php';
    exit;
}

if ($ext[0] == "dashboard_get_images_process") {
    include $root . '/view/dashboard/get_images.php';
    exit;
}

if ($ext[0] == "dashboard_delete_image_process") {
    include $root . '/view/dashboard/delete_image.php';
    exit;
}
if ($ext[0] == "dashboard_delete_image_all_process") {
    include $root . '/view/dashboard/delete_image_all.php';
    exit;
}



// 404 Page
include $root . '/php_modules/bad_request.php';
