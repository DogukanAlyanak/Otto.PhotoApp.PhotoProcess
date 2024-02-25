<?php

// No Browser Cache
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Time Zone
date_default_timezone_set('Europe/Istanbul');

$_configs = json_decode(file_get_contents($root . "/_configs.json"), true);

// Database Settings
$dbname = $_configs["database"]["database-name"];
$dbuser = $_configs["database"]["username"];
$dbpass = $_configs["database"]["password"];


// Image Process Settings
$ProcessImageQueueLimit = 5;
$uploadedTimeMinPassingTime = 30;




