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





// images //////////////////////////////////////////////////////
$sqlData = [];
$sql = $db->prepare("SELECT 
        SYSTEM_FILE_NAME
    FROM images

    ORDER BY ID DESC
");
$sql->execute([]);
$sqlData = $sql->fetchAll(PDO::FETCH_ASSOC);

$imageList = [];
foreach ($sqlData as $i => $e) {
    $imageList[] = $e["SYSTEM_FILE_NAME"];
}





// images wait //////////////////////////////////////////////////////
include $root . "/php_modules/sort_files.php";
$waitImageList = sortFiles("upload");








//  ---  WHEN  EVERYTHING  SUCCESSFULL  ---  //////////////////////////////////////////////
$res = [];
$res['state'] = 'success';
$res['message'] = 'Fotoğraflar Bulundu!';
$res['data'] = $imageList;
$res['data2'] = $waitImageList;
$res['errorcode'] = 'PS999';
echo json_encode($res);