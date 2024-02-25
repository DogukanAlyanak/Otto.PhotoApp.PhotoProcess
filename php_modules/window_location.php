<?php


$windowLocationHost         = strval(@$_SERVER["HTTP_HOST"]);
$windowLocationHostname     = strval(@explode(":", $_SERVER["HTTP_HOST"])[0]);
$windowLocationPort         = strval(@explode(":", $_SERVER["HTTP_HOST"])[1]);

$windowLocationProtocol     = strval(@$_SERVER["REQUEST_SCHEME"] . ":");
$windowLocationOrigin       = strval(@$_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["HTTP_HOST"]);

$windowLocationPathname     = strval(@explode("?", $_SERVER["REQUEST_URI"])[0]);
$windowLocationSearch       = strval("?" . @explode("?", $_SERVER["REQUEST_URI"])[1]);

$windowLocationHref         = strval(@$_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);


if ($windowLocationSearch == "?") {
    $windowLocationSearch = "";
}

$window["location"]["host"]         = $windowLocationHost;
$window["location"]["hostname"]     = $windowLocationHostname;
$window["location"]["protocol"]     = $windowLocationHost;
$window["location"]["port"]         = $windowLocationPort;
$window["location"]["origin"]       = $windowLocationOrigin;
$window["location"]["pathname"]     = $windowLocationPathname;
$window["location"]["search"]       = $windowLocationSearch;
$window["location"]["href"]         = $windowLocationHref;