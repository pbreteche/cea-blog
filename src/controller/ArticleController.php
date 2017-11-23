<?php

namespace Pierre\controller;


use Pierre\controller\http\Response;
use Pierre\model\ArticleRepository;
use Pierre\model\RepositoryFactory;

class ArticleController
{
    /**
     * Liste des derniers articles
     *
     * @return Response
     */
    public function indexAction(): Response
    {
        $repositoryContainer = new RepositoryFactory();
        /** @var \Pierre\model\ArticleRepository $articleRepository */
        $articleRepository = $repositoryContainer->get('article');
        $articles = $articleRepository->findLatest();
        /*return $this->renderHomeMade(
            'article',
            [
                'articles' => $articles,
                'title' => 'Latest news !'
            ]
        );
        */
        return $this->renderByTwig(
            'index.html.twig',
            [
                'articles' => $articles,
                'title' => 'Latest news !'
            ]
        );
    }

    private function renderByTwig($template, $data)
    {
        $loader = new \Twig_Loader_Filesystem(APP_ROOT . '/src/view');
        $twig = new \Twig_Environment($loader);
        return new Response(
            200,
            $twig->render($template, $data)
        );
    }

    private function renderHomeMade($templateConfig, $data)
    {
        return new Response(
            200,
            (new TemplateEngine($templateConfig))->render($data)
        );
    }

    public function showAction($id): Response
    {

        $repositoryContainer = new RepositoryFactory();
        /** @var \Pierre\model\ArticleRepository $articleRepository */
        $articleRepository = $repositoryContainer->get('article');
        $article = $articleRepository->findById($id);
        return $this->renderByTwig(
            'show.html.twig',
            [
                'article' => $article,
                'title' => 'Latest news !'
            ]
        );
    }
}