<?php

namespace Pierre\controller;


use Pierre\controller\http\Response;
use Pierre\model\ArticleRepository;
use Pierre\model\RepositoryFactory;

class ArticleController
{

    public function __construct()
    {
        $this->templateEngine = new TemplateEngine();
    }

    /**
     * Liste des derniers articles
     *
     * @return Response
     */
    public function indexAction(): Response
    {
        /** @var \Pierre\model\ArticleRepository $articleRepository */
        $articleRepository = RepositoryFactory::get('article');
        $articles = $articleRepository->findLatest();
        return new Response(
            200,
            $this->templateEngine->render(
                'article',
                [
                    'articles' => $articles,
                ]
            )
        );
    }

    public function showAction(): Response
    {
        return new Response(200, 'show action works');
    }
}