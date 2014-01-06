<?php
ini_set('display_errors', 1);

$filename = __DIR__ . preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
if (php_sapi_name() === 'cli-server' && is_file($filename)) {
    return false;
}

require 'vendor/autoload.php';

$app = new \Ranyuen\App('development');
$app->run();
