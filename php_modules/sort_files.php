<?php

if (!function_exists('sortFiles')) {
    function sortFiles($path = '.') {
        $allFiles = [];
        $files = scandir($path);

        foreach ($files as $file) {
            if ($file == '.' || $file == '..' || $file == '.git') {
                continue;
            }

            $allFiles[] = $file;
            if (is_dir($path . DIRECTORY_SEPARATOR . $file)) {
                $allFiles[$file] = sortFiles($path . DIRECTORY_SEPARATOR  . $file);
            }
        }
        return $allFiles;
    }
}