<?php

if (isset($db) == false) {
    if ($_SERVER['HTTP_HOST'] == "localhost" 
    || $_SERVER['HTTP_HOST'] == "127.0.0.1") {
        $dbhost = "localhost";
        $dbname = $dbname;
        $dbuser = "root";
        $dbpass = "";
    } else {
        $dbhost = "localhost";
        $dbname = $dbname;
        $dbuser = $dbuser;
        $dbpass = $dbpass;
    }

    //Veritabanı Bağlanma Hata Ayıklama
    try {
        $db = new PDO("mysql:host=$dbhost;dbname=$dbname; charset=utf8", "$dbuser", "$dbpass");
    } catch (PDOException $e) {
        print $e->getMessage();
    }
    unset($dbhost);
    unset($dbname);
    unset($dbuser);
    unset($dbpass);
}