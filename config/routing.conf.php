<?php

return [
    '/' => [
        'controller_class' => 'Pierre\\controller\\ArticleController',
        'controller_method' => 'indexAction'
    ],
    '/article/([^/]+)' => [
        'controller_class' => 'Pierre\\controller\\ArticleController',
        'controller_method' => 'showAction'
    ],
];
