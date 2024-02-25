<?php

if(!isset($_SESSION))  { 
    session_start(); 
} 

/* $time = $_SERVER['REQUEST_TIME'];
$timeout_duration = 3600;

if (isset($_SESSION['LAST_ACTIVITY']) && 
($time - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    session_unset();
    session_destroy();
    session_start();
} */