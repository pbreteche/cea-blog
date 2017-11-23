<?php
/**
 * Created by PhpStorm.
 * User: pierre
 * Date: 23/11/17
 * Time: 11:32
 */

namespace controller;


use PHPUnit\Framework\TestCase;
use Pierre\model\Article;
use Pierre\model\ArticleCache;
use Pierre\model\ArticleRepository;

class ArticleCacheTest extends TestCase
{

    public function testCountLatest()
    {
        $repoStub = $this->createMock(ArticleRepository::class);

        $repoStub->method('findLatest')
            ->willReturn([
                new Article('premier titre'),
                new Article('encore un autre'),
            ]);

        $ac = new ArticleCache();

        $this->assertEquals(2, $ac->countLatest());
    }

}