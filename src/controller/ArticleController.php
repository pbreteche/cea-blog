<?php

namespace Pierre\controller;


use Pierre\controller\http\Response;

class ArticleController {

    public function indexAction(): Response {

        return new Response(200, 'index action works');
    }

    public function showAction(): Response {
        return new Response(200, 'show action works');
    }
}