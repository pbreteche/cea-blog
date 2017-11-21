<?php

namespace Pierre;

use Pierre\controller\http\Request;
use Pierre\controller\http\Response;
use Pierre\controller\http\RouteNotFoundException;
use Pierre\controller\http\Router;

class BlogApp {

    public function handle(Request $request): Response {

        $router = new Router(APP_ROOT . '/config/routing.conf.php');

        try {
            $routeInfo = $router->match($request);
            var_dump($routeInfo);
        }
        catch (RouteNotFoundException $e) {
            require APP_ROOT . '/web/error404.php';
            die;
        }

        return new Response(200, '
        <link rel="stylesheet" href="/css/blog.css">
        <body>Hello world</body>
        ');
    }
}