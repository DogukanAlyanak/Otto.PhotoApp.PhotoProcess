<?php


if (!function_exists("createToken")) {
    function createToken($e=30, $x=30) {
        
        $year = strtotime(date("Y") . "-01-01 00:00:00");
        $now = strtotime("now");
        $e = intval(@$e);
        $x = intval(@$x);
        
        $e = rand($e, $x);

        $sec  = str_pad($now - $year, 8, "0", STR_PAD_LEFT);
        $uniq = intval(date("y") . $sec);
        $key = base_convert($uniq, 10, 36);

        $ch = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $word = "";
        for ($i = 0; $i < $e - strlen($key); $i++) {
            $word .= $ch[rand(0, strlen($ch) - 1)];
        }

        $bgnL = intval(strlen($word) / 3);
        $bgnKeyWord = substr($word, 0, $bgnL);
        $endKeyWord = substr($word, $bgnL);
        
        return $bgnKeyWord . $key . $endKeyWord;
    }
}