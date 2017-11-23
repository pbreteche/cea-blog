<?php

namespace Pierre;

use Pierre\controller\http\Request;
use Pierre\controller\http\Response;
use Pierre\controller\http\RouteNotFoundException;
use Pierre\controller\http\Router;

class BlogApp
{

    public function handle(Request $request): Response
    {

        $router = new Router(APP_ROOT . '/config/routing.conf.php');

        try {
            $routeInfo = $router->match($request);
        } catch (RouteNotFoundException $e) {
            require APP_ROOT . '/web/error404.php';
            die;
        }

        $controller = new $routeInfo['controller_class'];
        return call_user_func(
            [$controller, $routeInfo['controller_method']],
            ...$routeInfo['parameters']
        );

    }
}