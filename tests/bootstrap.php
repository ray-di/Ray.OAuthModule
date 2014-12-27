<?php

require dirname(__DIR__) . '/vendor/autoload.php';

$_ENV['TMP_DIR'] = __DIR__ . '/tmp';

$_SERVER['REQUEST_URI'] = 'http://example.com/test?key=value';
$_SESSION = [];
