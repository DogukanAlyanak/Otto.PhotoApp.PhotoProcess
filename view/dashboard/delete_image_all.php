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


$now = date("Y-m-d H:i:s");











// --- PROCESS  --- ////////////////////////////////////////////
$sql = $db->prepare("DELETE FROM images");
$theSql = $sql->execute();
if (!$theSql) {
    $res['state'] = 'error';
    $res['message'] = 'Tüm fotoğraflar silinemedi!';
    $res['errorcode'] = 'PS998';
    echo json_encode($res);
    exit;
}









//  ---  WHEN  EVERYTHING  SUCCESSFULL  ---  //////////////////////////////////////////////
$res = [];
$res['state'] = 'success';
$res['message'] = 'Tüm fotoğraflar silindi!';
$res['errorcode'] = 'PS999';
echo json_encode($res);
