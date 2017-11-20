<?php

namespace Pierre\controller\http;


class Response {

    /**
     * status code for HTTP response as defined in https://www.w3.org/Protocols/rfc2616/rfc2616.html
     *
     * @var int
     */
    private $status;

    /**
     * @var string
     */
    private $body;

    public function __construct(int $status, string $body = '') {
        $this->status = $status;
        $this->body = $body;
    }

    public function send() {
        http_response_code($this->status);
        echo $this->body;
    }


}