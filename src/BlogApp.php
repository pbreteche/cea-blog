<?php

namespace Pierre;

use Pierre\controller\http\Request;
use Pierre\controller\http\Response;

class BlogApp {

    public function handle(Request $request): Response {
        return new Response(200, 'Hello world');
    }
}