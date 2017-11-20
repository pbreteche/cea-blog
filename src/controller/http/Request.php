<?php

namespace Pierre\controller\http;


class Request {

    /**
     * @var string[]
     */
    private $getParameters;

    /**
     * @var string
     */
    private $query;

    public static function createFromGlobals(): self {
        $instance =new self;

        $instance->getParameters = $_GET;

        $instance->query = $_SERVER['REQUEST_URI'];

        return $instance;
    }

    /**
     * @return string[]
     */
    public function getGetParameters(): array {
        return $this->getParameters;
    }

    /**
     * @return string
     */
    public function getQuery(): string {
        return $this->query;
    }


}