<?php

/* TESTER */
if (!function_exists('tester')) {
    function tester($e = "", $x = "",  $y = "",  $z = "") {
        
        if ($x == "notheader" || $y == "notheader" || $z == "notheader") {
        } else {
            header('Content-Type: application/json');
        }
        if ($x == "notpretty" || $y == "notpretty" || $z == "notpretty") {
            echo json_encode($e);
        } else {
            echo json_encode($e, JSON_PRETTY_PRINT);
        }
        if ($x == "notexit" || $y == "notexit" || $z == "notexit") {
        } else {
            exit;
        }
    }
}