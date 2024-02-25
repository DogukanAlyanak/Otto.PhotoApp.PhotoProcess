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







// --- Post Data Catch ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$jsonPostData = file_get_contents('php://input');
$req = json_decode($jsonPostData, true);


// --- Data Control ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// post 
if (empty($req)) {
    $res['state'] = 'error';
    $res['message'] = 'Veriler alınamadı, Sayfayı yenilemeyi deneyebilirsiniz!';
    $res['errorcode'] = 'PS002';
    echo json_encode($res);
    exit;
}


$now = date("Y-m-d H:i:s");











// --- C O N T E N T   D E T A I L S --- ////////////////////////////////////////////
// IMAGE 
$columnName = "IMAGE";
if (isset($req[$columnName])) {
    $reqImageName = $req[$columnName];
} else {
    $res['state'] = 'error';
    $res['message'] = 'Veriler alınamadı, Sayfayı yenilemeyi deneyebilirsiniz!';
    $res['errorcode'] = 'PS005';
    echo json_encode($res);
    exit;
}











// --- F I X   V A R I A B L E S  --- ////////////////////////////////////////////
$reqImageName = trim($reqImageName);











// --- PROCESS  --- ////////////////////////////////////////////
$sql = $db->prepare("DELETE FROM images
    WHERE SYSTEM_FILE_NAME=?
");
$theSql = $sql->execute([
    $reqImageName
]);
if (!$theSql) {
    $res['state'] = 'error';
    $res['message'] = 'Seçilen fotoğraf silinemedi!';
    $res['errorcode'] = 'PS998';
    echo json_encode($res);
    exit;
}









//  ---  WHEN  EVERYTHING  SUCCESSFULL  ---  //////////////////////////////////////////////
$res = [];
$res['state'] = 'success';
$res['message'] = 'Seçilen fotoğraf silindi!';
$res['errorcode'] = 'PS999';
echo json_encode($res);
