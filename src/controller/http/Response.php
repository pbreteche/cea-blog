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

    /**
     * @var string[]
     */
    private $headers;

    public function __construct(int $status, string $body = '') {
        $this->status = $status;
        $this->body = $body;
        $this->headers = [];
    }

    public function setHeader($name, $value) {
        $this->headers[$name] = $value;
    }

    public function send() {
        http_response_code($this->status);
        foreach ($this->headers as $hname => $hvalue) {
            header($hname . ': ' . $hvalue);
        }
        echo $this->body;
    }
}