<?php


// lirraphotoprocess
// photo
// version : 3.2.1


// Defaults
$root = $_SERVER["DOCUMENT_ROOT"];
include $root . '/php_modules/window_location.php';


// Includes, php_modules
include $root . '/php_modules/tester.php';
include $root . '/php_modules/redirect.php';


// Configurations
include $root . '/configs.php';


// Connect DB
include $root . '/php_modules/connectdb.php';


// Session
include $root . '/php_modules/session.php';


// All Route Control
include $root . '/route.php';