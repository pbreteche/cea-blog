<?php

namespace Pierre\model;


class RepositoryFactory
{

    const CONFIG = [
        'article' => [
            'class' => 'Pierre\\model\\ArticleRepository',
            'args' => [],
        ],
    ];

    private static $instances = [];

    public static function get($repoName): EntityRepository
    {
        if (!key_exists($repoName, self::CONFIG)) {
            throw new \Exception();
        }

        if (!key_exists($repoName, self::$instances)) {
            $classname = self::CONFIG[$repoName]['class'];
            self::$instances[$repoName] =
                new $classname(...self::CONFIG[$repoName]['args'])
            ;
        }

        return self::$instances[$repoName];
    }
}