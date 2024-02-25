<?php

if (@$_SESSION["user_name"] == "administrator") {
    redirect($windowLocationOrigin . "/dashboard");
}

// Default Variables
header('Content-Type: application/json');
$root = $_SERVER["DOCUMENT_ROOT"];
$processRoot = $root . "/view/login";


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

include_once $root . "/configs.php";

$authUsername = $_configs["users"][0]["username"];
$authPassword = $_configs["users"][0]["password"];







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
// USERNAME 
$columnName = "USERNAME";
if (isset($req[$columnName])) {
    $reqUsername = $req[$columnName];
} else {
    $res['state'] = 'error';
    $res['message'] = 'Veriler alınamadı, Sayfayı yenilemeyi deneyebilirsiniz!';
    $res['errorcode'] = 'PS005';
    echo json_encode($res);
    exit;
}





// PASSWORD 
$columnName = "PASSWORD";
if (isset($req[$columnName])) {
    $reqPassword = $req[$columnName];
} else {
    $res['state'] = 'error';
    $res['message'] = 'Veriler alınamadı, Sayfayı yenilemeyi deneyebilirsiniz!';
    $res['errorcode'] = 'PS006';
    echo json_encode($res);
    exit;
}











// --- F I X   V A R I A B L E S  --- ////////////////////////////////////////////
$reqUsername = trim($reqUsername);
$reqPassword = trim($reqPassword);


if ($authUsername != $reqUsername 
 || $authPassword != $reqPassword
) {
    $res['state'] = 'error';
    $res['message'] = 'Hatalı Kullanıcı adı veya şifre!';
    $res['errorcode'] = 'PS007';
    echo json_encode($res);
    exit;
}









//  ---  WHEN  EVERYTHING  SUCCESSFULL  ---  //////////////////////////////////////////////
$_SESSION["user_name"] = "administrator";


$res = [];
$res['state'] = 'success';
$res['message'] = 'Başarılı Giriş!';
$res['errorcode'] = 'PS999';
echo json_encode($res);