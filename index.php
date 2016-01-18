<?php

header("Content-type: text/html;charset=utf8");

// define system constants
define ('BASE_PATH', __DIR__);
define ('APP_PATH', BASE_PATH . '/app');
define ('SERVER_NAME', '/test-livetex/');

// PDO CONNECTION DETAILS
define ('DB_HOST', 'localhost');
define ('DB_NAME', 'html_parser');
define ('DB_USER', 'user');
define ('DB_PASS', 'password');

// use namespace autoloader
$autoloader = include_once BASE_PATH . "/vendor/autoload.php";

$autoloader->add('', APP_PATH);
$autoloader->add('Controller', APP_PATH);
$autoloader->add('Model', APP_PATH);

$app = new App();
$app->execute();
