<?php

namespace Pierre\controller\http;


class Router {

    /**
     * @var array
     */
    private $routes;

    /**
     * Router constructor.
     *
     * @param string $configPath
     */
    public function __construct(string $configPath)
    {
        $this->routes = require $configPath;
    }

    /**
     * @param Request $request
     *
     * @return array
     * @throws RouteNotFoundException
     */
    public function match(Request $request): array {
        $requestPath = $request->getPath();

        foreach ($this->routes as $routePath => $routeConfig) {

            if (preg_match($this->generateRegEx($routePath), $requestPath, $matches)) {
                array_shift($matches);
                $routeConfig['parameters'] = $matches;
                return $routeConfig;
            }
        }
        throw new RouteNotFoundException();
    }

    private function generateRegEx(string $routePath): string {
        return '/^' . str_replace('/','\/',$routePath) . '$/';
    }
}