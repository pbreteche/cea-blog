<?php

namespace controller;

use PHPUnit\Framework\TestCase;
use Pierre\model\ArticleRepository;
use Pierre\model\EntityRepository;
use Pierre\model\RepositoryFactory;

class RepositoryFactoryTest extends TestCase
{

    /**
     * @before
     */
    public function prepare()
    {
        // init mocks
    }

    /**
     * @dataProvider repositoryProvider
     */
    public function testGet($repoName, $repoClassname)
    {
        $repo = new RepositoryFactory;
        $result = $repo->get($repoName);

        $this->assertInstanceOf(
            EntityRepository::class,
            $result,
            'Il faut une bonne instance de dépôt'
        );
        $this->assertInstanceOf(
            $repoClassname,
            $result,
            'Il faut une bonne instance de dépôt'
        );
        //$this->markTestIncomplete();
    }

    public function repositoryProvider()
    {
        return [
            'Article repository dataset' => ['article', ArticleRepository::class],
        ];
    }

    /**
     * @expectedException \Exception
     */
    public function testGetWithBadArgument()
    {
        $repo = new RepositoryFactory;
        $result = $repo->get('bad-repository');
    }
}