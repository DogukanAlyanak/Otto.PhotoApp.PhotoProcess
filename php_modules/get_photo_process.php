<?php


// includes
include $root . "/php_modules/guidv4.php";
include $root . "/php_modules/create_token.php";
include $root . "/php_modules/sort_files.php";
include $root . "/php_modules/exif_fix.php";
include $root . "/php_modules/eastImageResize.php";


// Defines
$folderPath["upload"]       = $root . "/upload";
$folderPath["fullscreen"]   = $root . "/public/fullscreen";
$folderPath["photo"]        = $root . "/public/photos";
$folderPath["thumbnail"]    = $root . "/public/thumbnails";
$folderPath["backup"]       = $root . "/system/backup/media";





// Create Nacacerry Files ///////////////////////////////////////////
foreach ($folderPath as $i => $e) {
    if (!file_exists($e)) {
        mkdir($e, 0777, true);
    }
}





// SET BACKUP AND SAVE TO DATABASE ///////////////////////////////////////////
// Sort Upload Files 
$uploadFiles = sortFiles($folderPath["upload"]);


foreach ($uploadFiles as $i => $uploadFileName) {
    $uploadFilePath = $folderPath["upload"] . "/" . $uploadFileName;


    // Image Infos
    $file = [];
    $fileinfo = getimagesize($uploadFilePath);
    $file["name"] = $uploadFileName;
    $file["byte"] = filesize($uploadFilePath);
    $file["format"] = $fileinfo["mime"];
    $file["time"] = filemtime($uploadFilePath);


    // Image Controller
    if (
        $file["format"] != "image/jpeg"
        && $file["format"] != "image/png"
        && $file["format"] != "image/gif"
    ) {
        continue;
    } else if ($file["byte"] < 21600) {
        continue;
    } else if ($file["time"] > strtotime("now") - 30) {
        continue;
    }


    // Get Current QR Code Tokens
    $currentQRCodeTokens = [];
    $sqlData = [];
    $sql = $db->prepare("SELECT 
            QR_CODE
        FROM images
    ");
    $sql->execute([]);
    $sqlData = $sql->fetchAll(PDO::FETCH_ASSOC);


    // Create QR Code Token
    do {
        $QRCodeToken = createToken(7, 25);
    } while (in_array($QRCodeToken, $currentQRCodeTokens));


    // Set System File Name
    $systemFileName = guidv4();
    switch ($file["format"]) {
        case "image/jpeg":
            $systemFileName .= ".jpg";
            break;
        case "image/png":
            $systemFileName .= ".png";
            break;
        case "image/gif":
            $systemFileName .= ".gif";
            break;
    }


    // Save to Database
    $sql = $db->prepare("INSERT INTO images SET 
        ORIGINAL_FILE_NAME=?,
        SYSTEM_FILE_NAME=?,
        QR_CODE=?
    ");
    $theSql = $sql->execute([
        $uploadFileName,
        $systemFileName,
        $QRCodeToken
    ]);
    if (!$theSql) {
        continue;
    }



    $backupFilePath = $folderPath["backup"] . "/" . $systemFileName;
    if (!copy($uploadFilePath, $backupFilePath)) {
        continue;
    } else {
        unlink($uploadFilePath);
    }
}






// PREPARE AND CHECK PROCESS FILES
// Saved to Database Files
$databaseFiles = [];
$sql = $db->prepare("SELECT 
        SYSTEM_FILE_NAME as name,
        CREATE_DATE as time

    FROM images

    ORDER BY CREATE_DATE ASC
");
$sql->execute([]);
$databaseFiles = $sql->fetchAll(PDO::FETCH_ASSOC);


// Tumbnail files
$thumbnailFiles = sortFiles($folderPath["thumbnail"]);


// Tumbnail files Check
foreach ($thumbnailFiles as $i => $thumbnailFileName) {
    $thumbnailFilePath = $folderPath["thumbnail"] . "/" . $thumbnailFileName;
    if (filesize($thumbnailFilePath) < 21600) {
        unset($thumbnailFiles[$i]);
    }
}


// drop finished files from process file list
$processFiles = [];
foreach ($databaseFiles as $i => $databaseFile) {
    if (in_array($databaseFile["name"], $thumbnailFiles) == false) {
        $processFiles[] = $databaseFile;
    }
}


// drop not have files from process file list
foreach ($processFiles as $i => $processFile) {
    $backupFilePath = $folderPath["backup"] . "/" . $processFile["name"];

    if (intval(@filemtime($backupFilePath)) < 21600) {
        unset($processFiles[$i]);
    }
}


// Set Limit Process Files
$arr = [];
$j = 0;
foreach ($processFiles as $i => $processFile) {
    if (++$j <= $ProcessImageQueueLimit) { // settings in configs.php
        $arr[] = $processFile;
    }
}
$processFiles = $arr;
unset($arr);





// PROCESS IMAGES ////////////////////////////////////////////////////////////////////
foreach ($processFiles as $i => $file) {
    $backupFilePath = $folderPath["backup"] . "/" . $file["name"];


    if (filesize($backupFilePath) < 21600) {
        continue;
    }


    // IMAGE FORMAT PROCESS ////////////////////////////////////////////////
    // File Info
    $fileinfo = getimagesize($backupFilePath);
    $file["path"] = $backupFilePath;
    $file["format"] = $fileinfo["mime"];
    $file["width"] = intval($fileinfo["0"]);
    $file["height"] = intval($fileinfo["1"]);

    $width  = $file["width"];
    $height = $file["height"];



    // Load
    if ($file["format"] == "image/jpeg") {
        $image = imagecreatefromjpeg($file["path"]);
    } elseif ($file["format"] == "image/png") {
        $image = imagecreatefrompng($file["path"]);
    } elseif ($file["format"] == "image/gif") {
        $image = imagecreatefromgif($file["path"]);
    }


    // Exif Rotate Fix
    $fixedImage = image_fix_orientation($image, $file["path"]);
    $image  = $fixedImage["image"];
    $width  = $fixedImage["width"];
    $height = $fixedImage["height"];


    // MERGE PROCESS /////////////////////////////////////////////////////////
    // Flig1
    $flig1Path = $root . "/assets/flig1.png";

    $newFlig1Width  = intval($width / 100 * 18);
    $newFlig1Height = $newFlig1Width;

    $flig1Source = imagecreatefrompng($flig1Path);
    
    $flig1OldWeight = intval(getimagesize($flig1Path)["0"]);
    $flig1OldHeight = intval(getimagesize($flig1Path)["1"]);

    $flig1 = imagecreatetruecolor($newFlig1Width, $newFlig1Height);
    imagesavealpha($flig1, true);
    imagealphablending($flig1, false);

    imagecopyresampled($flig1, $flig1Source, 0, 0, 0, 0, $newFlig1Width, $newFlig1Height, $flig1OldWeight, $flig1OldHeight);






    // Flig2
    $flig2Path = $root . "/assets/flig2.png";

    $newFlig2Width  = $width + 2;
    $newFlig2Height = $width + 2;

    $flig2Source = imagecreatefrompng($flig2Path);
    
    $flig2OldWeight = intval(getimagesize($flig2Path)["0"]);
    $flig2OldHeight = intval(getimagesize($flig2Path)["1"]);

    $flig2 = imagecreatetruecolor($newFlig2Width, $newFlig2Height);
    imagesavealpha($flig2, true);
    imagealphablending($flig2, false);

    imagecopyresampled($flig2, $flig2Source, 0, 0, 0, 0, $newFlig2Width, $newFlig2Height, $flig2OldWeight, $flig2OldHeight);

    



    $flig1x = intval(($width / 2) - ($newFlig1Width / 2));
    $flig1y = intval($height - ($newFlig2Height / 2 / 100 * 17) - ($newFlig1Height / 2));

    $flig2x = -1;
    $flig2y = ($height - ($newFlig2Height/2));

    









    $mergedImage = imagecreatetruecolor($width, $height);

    imagealphablending($mergedImage, true);
    imagesavealpha($mergedImage, true);

    imagecopy($mergedImage, $image, 0, 0, 0, 0, $width, $height);
    imagedestroy($image);

    imagecopy($mergedImage, $flig2, $flig2x, $flig2y, 0, 0, $newFlig2Width, $newFlig2Height);
    imagedestroy($flig2);

    imagecopy($mergedImage, $flig1, $flig1x, $flig1y, 0, 0, $newFlig1Width, $newFlig1Height);
    imagedestroy($flig1);
    


    // SAVE ORJ SIZE PROCESS /////////////////////////////////////////////////////////
    $mergedFilePath = $folderPath["photo"] . "/" . $file["name"];

    if ($file["format"] == "image/jpeg") {
        imagejpeg($mergedImage, $mergedFilePath, 100);
    } elseif ($file["format"] == "image/png") {
        imagepng($mergedImage, $mergedFilePath, 9);
    } elseif ($file["format"] == "image/gif") {
        imagegif($mergedImage, $mergedFilePath, 100);
    }
    imagedestroy($mergedImage);
}








// RESIZE FOR FULLSCREEN ////////////////////////////////////////////////////////////
foreach ($processFiles as $i => $file) {

    $mergedFilePath     = $folderPath["photo"] . "/" . $file["name"];
    $fullscreenFilePath = $folderPath["fullscreen"] . "/" . $file["name"];
    $thumbnailFilePath  = $folderPath["thumbnail"] . "/" . $file["name"];

    eastImage($mergedFilePath, 1920, $fullscreenFilePath);
    eastImage($mergedFilePath, 1280, $thumbnailFilePath);
}

echo "successful";
