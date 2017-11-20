<?php

require __DIR__ . '/../vendor/autoload.php';

$request = Pierre\controller\http\Request::createFromGlobals();
$app = new Pierre\BlogApp();
$response = $app->handle($request);
$response->send();
