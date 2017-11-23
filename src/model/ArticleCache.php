<?php
/**
 * Created by PhpStorm.
 * User: pierre
 * Date: 23/11/17
 * Time: 11:41
 */

namespace Pierre\model;


class ArticleCache
{

    public function __construct( )
    {
        $this->repo = new ArticleRepository(new \PDO(''));
    }

    public function countLatest()
    {
        return count($this->repo->findLatest());
    }
}