<?php

namespace Pierre\controller\http;


use Pierre\service\Logger;

class Request
{

    /**
     * @var string[]
     */
    private $getParameters;

    /**
     * @var string
     */
    private $query;

    /**
     * @var string
     */
    private $path;

    public static function createFromGlobals(): self
    {
        $instance = new self;

        $instance->getParameters = $_GET;
        $instance->query = $_SERVER['REQUEST_URI'];
        $instance->path = $_SERVER['PATH_INFO'];

        Logger::get()->debug('Request is build from super globals (avec sa cape rouge)');



        return $instance;
    }

    /**
     * @return string[]
     */
    public function getGetParameters(): array
    {
        return $this->getParameters;
    }

    /**
     * @return string
     */
    public function getQuery(): string
    {
        return $this->query;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }


}