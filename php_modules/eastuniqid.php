<?php

if (!function_exists("eastuniqid")) {
    function eastuniqid($e = 13, $table = 'none', $key = 'ID') {
        if ($table == 'none') {
            return createeastuniqid($e);
        } else {
            include $_SERVER['DOCUMENT_ROOT'] . '/module/connectdb.php';

            do {
                $req = createeastuniqid($e);
                $sql = $db->prepare("SELECT * FROM $table WHERE $key='$req'");
                $sql->execute();
                $theSql = $sql->fetchAll(PDO::FETCH_ASSOC);

            } while (count($theSql) > 0);
            return $req;
        }
    }
}


if (!function_exists("createeastuniqid")) {
    function createeastuniqid($e = 13) {
        if ($e < 13) { $e = 13; }
        if ($e > 28) { $e = 28; }
        
        $randCount = $e-10;
        $randFirst = intval(str_pad(1, $randCount, "0", STR_PAD_RIGHT));
        $randLast = intval(str_pad(9, $randCount, "9", STR_PAD_RIGHT));
        $rand = rand($randFirst, $randLast);

        $now = strtotime("now");
        $yearStart = strtotime(date("Y") . "-01-01 00:00:00");
        $diff = str_pad($now - $yearStart, 8, "0", STR_PAD_LEFT);
        return intval(date("y") . $diff) . $rand;
    }
}