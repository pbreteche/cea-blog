<?php

namespace Pierre\model;


class ArticleRepository implements EntityRepository
{
    public function findLatest()
    {
        return [
            new Article('titre 1'),
            new Article('titre deux'),
        ];
    }
}