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
$saveToDB = true;
$db['host'] = 'localhost';
$db['dbname'] = 'DB_NAME';
$db['user'] = 'DB_USER';
$db['pass'] = 'DB_PASSWORD';

$showStoryUsername = ["target1", "target2"]; // Target

?>
