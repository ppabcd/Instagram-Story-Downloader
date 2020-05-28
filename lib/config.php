<?php
use InstagramAPI\Instagram;

header('Content-Type: text/html; charset=utf-8');
set_time_limit(0);
date_default_timezone_set('UTC');
require __DIR__ . '/../vendor/autoload.php';
Instagram::$allowDangerousWebUsageAtMyOwnRisk = true;

$username = "IG_USERNAME";
$password = "IG_PASSWORD";

// Biarin default aja
$debug = false;
$truncatedDebug = false;

// Database
$saveToDB = false;
$db['host'] = 'localhost';
$db['dbname'] = 'DBNAME';
$db['user'] = 'DB_USERNAME';
$db['pass'] = 'DB_PASSWORD';

$showStoryUsername = ["target1", "target2"]; // Target

?>
