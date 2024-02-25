<?php


if (!function_exists('image_fix_orientation')) {
    function image_fix_orientation($image, $filePath) {
        $exif = exif_read_data($filePath);

        $fileinfo = getimagesize($filePath);

        $w  = intval($fileinfo["0"]);
        $h = intval($fileinfo["1"]);

        $width  = $w;
        $height = $h;



        if (!empty($exif['Orientation'])) {
            switch ($exif['Orientation']) {
                case 3:
                    $image = imagerotate($image, 180, 0);
                    break;

                case 6:
                    $image = imagerotate($image, -90, 0);
                    $width  = $h;
                    $height = $w;
                    break;

                case 8:
                    $image = imagerotate($image, 90, 0);
                    $width  = $h;
                    $height = $w;
                    break;
            }
        }
        $res = [];
        $res["image"] = $image;
        $res["width"] = $width;
        $res["height"] = $height;
        return $res;
    }
}
