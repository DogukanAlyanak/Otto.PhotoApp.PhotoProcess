<?php

/* using : 
    $filename = "https://photoapp.ottoturkiye.com/media/42a72fb1-cedd-11ec-8569-6b18cba758b9.jpg";
    eastImageResize($filename, 1920, "");
*/

/* support: jpg, png, gif */

if (!function_exists("eastImage")) {
    function eastImage($filename, $maxSize = null, $savePath = null) {
        

        if (intval(@filesize($filename)) < 21600) {
            return false;
        }


        // File Define
        // $filename = image.jpg";
        $fileinfo = getimagesize($filename);

        $file["path"] = $filename;
        $file["width"] = intval($fileinfo["0"]);
        $file["height"] = intval($fileinfo["1"]);
        $file["format"] = $fileinfo["mime"];

        unset($filename);
        unset($fileinfo);

        $width = $file["width"];
        $height = $file["height"];

        if ($file["format"] != "image/jpeg"
         && $file["format"] != "image/png"
         && $file["format"] != "image/gif"
        ) {
            return false;
        }



        // Get new sizes
        if ($maxSize == null || $maxSize == $width) {
            $newWidth = $width;
            $newHeight = $height;
        } else {
            $resize = $maxSize;

            $newWidth = $resize;
            $newHeight = $height / ($width / $newWidth);

            // Get in maxSize = 1024x512 => 512x256
            if ($newHeight > $resize) {
                $oldHeight = $newHeight;
                $newHeight = $resize;
                $newWidth = $newHeight * $newHeight / $oldHeight;
            }

            $newWidth = intval($newWidth);
            $newHeight = intval($newHeight);
        }



        // Load
        if ($file["format"] == "image/jpeg") {
            $source = imagecreatefromjpeg($file["path"]);
        } elseif ($file["format"] == "image/png") {
            $source = imagecreatefrompng($file["path"]);
        } elseif ($file["format"] == "image/gif") {
            $source = imagecreatefromgif($file["path"]);
        }



        // Create Type
        if ($file["format"] == "image/jpeg") {
            $image = imagecreatetruecolor($newWidth, $newHeight);
        } elseif ($file["format"] == "image/png") {
            $image = imagecreatetruecolor($newWidth, $newHeight);
            imagesavealpha($image, true);
            imagealphablending($image, false);
        } elseif ($file["format"] == "image/gif") {
            $image = imagecreatetruecolor($newWidth, $newHeight);
        }



        // Blur
        $blurRange = 0;
        if ($width != $newWidth) {
            $blurRange = intval($width / $newWidth);
            if ($blurRange < 0) {
                $blurRange = $blurRange * -1;
            }

            if ($blurRange > 0) {
                imagefilter($source, IMG_FILTER_GAUSSIAN_BLUR, $blurRange * 1000 - 1);
                imagefilter($source, IMG_FILTER_SMOOTH, 99);
            }
        }
        unset($blurRange);
        // imagefilter($source, IMG_FILTER_BRIGHTNESS, 10); 
        


        // Resize
        imagecopyresampled($image, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        


        // Output
        if ($file["format"] == "image/jpeg") {
            imagejpeg($image, $savePath, 100);
        } elseif ($file["format"] == "image/png") {
            imagepng($image, $savePath, 9);
        } elseif ($file["format"] == "image/gif") {
            imagegif($image, $savePath, 100);
        }

        imagedestroy($image);
        return true;
    }
}
