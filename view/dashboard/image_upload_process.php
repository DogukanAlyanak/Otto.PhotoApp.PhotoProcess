<?php

if (@$_SESSION["user_name"] != "administrator") {
    $res['state'] = 'error';
    $res['message'] = '401 Unauthorized!';
    echo json_encode($res);
    exit;
}

// Default Variables
header('Content-Type: application/json');
$root = $_SERVER["DOCUMENT_ROOT"];
$processRoot = $root . "/view/dashboard";


/* Default Response */
$res = [
    'state' => 'error',
    'message' => 'Bilinmeyen bir hata oluştu!'
];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $res['state'] = 'error';
    $res['message'] = '400 Bad Request!';
    echo json_encode($res);
    exit;
}




// UPLOAD PROCESS ///////////////////////////////////////////////////////////////////
/* postta dosya varmı kontrol et */
if (!isset($_FILES['file'])) {
    $res['state'] = 'warning';
    $res['message'] = 'Lütfen bir dosya seçiniz!';
    $res['errorcode'] = 'IMGU001';
    echo json_encode($res);
    return;
}


/* Doysanın yükleneceği klasörler varmı yoksa oluştur */
$rootPath = $root . '/upload';          // Dosyanın Yükleneceği yol.
if (!file_exists($rootPath)) {          // klasörü yoksa oluştur.
    mkdir($rootPath, 0777, true);
}

/* Kabul edilebilir dosya tipleri */
$confirmExtensions = ['jpg', 'jpeg', 'png'];

/* Post Edilen Dosyalanın Bilgilerini çek */
$fileCount = count($_FILES['file']);					// Post edilen Dosya Sayısı
$fileName = $_FILES['file']['name'];						// filename.jpg
$fileTemp = $_FILES['file']['tmp_name'];					// C:\xampp\tmp\php409C.tmp
$fileType = $_FILES['file']['type'];						// application/octet-stream
$fileSize = $_FILES['file']['size'];						// "10135956" (byte (B))  (9,66 MB) (dosya boyutu)
$fileExt = @strtolower(end(explode('.', $fileName)));			// jpg

/* Dosya boyutu kontrolü */
$maxFileSize = 32 /* MB */;
$maxFuncFileSize = $maxFileSize * 1048576 /* GB * MB * BYTE */;
if ($fileSize > $maxFuncFileSize) {
    $res['state'] = 'error';
    $res['message'] = 'Yükleyeceğiniz dosya ' . $maxFileSize . " MB'ı geçmemelidir!";
    echo json_encode($res);
    exit;
}


/* Onaylanan uzantıları kontrol et */
$firstConfirmExtension = $confirmExtensions[0];
if (!in_array($fileExt, $confirmExtensions)) {
    foreach ($confirmExtensions as $confirmExtension) {
        if ($firstConfirmExtension == $confirmExtension) {
            $errorMessage = $confirmExtension;
        } else {
            $errorMessage =  $errorMessage . ', ' . $confirmExtension;
        }
    }
    $errorMessage = 'Kabul edilebilir uzantılar : ' . $errorMessage;
    $res['state'] = 'warning';
    $res['message'] = $errorMessage;
    echo json_encode($res);
    exit;
}

/*  Yeni Dosya Adı Oluştur */
include_once $root .'/php_modules/uniqurlid.php';
$newFilename = date("YmdHis") . uniqurlid(40) . '.' . $fileExt;
$newFile = $rootPath . '/' . $newFilename;
move_uploaded_file($fileTemp, $newFile);


/* Dosya Yüklendi mi Kontrol */
if (!file_exists($newFile)) {
    $res['state'] = 'error';
    $res['message'] = 'Dosya yüklenirken bir hata oluştu!';
    echo json_encode($res);
    exit;
} else {
    $res['state'] = 'success';
    $res['message'] = 'Dosya yüklendi!';
    //$res['filepath'] = $newFile;
    // $res['filename'] = $fileName;
    // $res['newFilename'] = $newFilename;
    echo json_encode($res);
    exit;
}









//  ---  WHEN  EVERYTHING  SUCCESSFULL  ---  //////////////////////////////////////////////
$res = [];
$res['state'] = 'success';
$res['message'] = 'Fotoğraflar Bulundu!';
$res['data'] = $imageList;
$res['errorcode'] = 'PS999';
echo json_encode($res);