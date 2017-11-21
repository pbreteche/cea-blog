<?php

if (preg_match('/\.(css|js)$/', $_SERVER['SCRIPT_NAME'])) {
    if (file_exists(__DIR__ . '/web' . $_SERVER['SCRIPT_NAME'])) {
        return false; // joue la requête de manière inchangée
    }
    require __DIR__ . '/web/error404.php';
    die;
}

$_SERVER['PATH_INFO'] = $_SERVER['PATH_INFO'] ?? explode('?', $_SERVER['REQUEST_URI'])[0];

file_put_contents('php://stderr', $_SERVER['PATH_INFO']);

require __DIR__ . '/web/index.php';
die;
