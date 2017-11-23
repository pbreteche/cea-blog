<?php

namespace Pierre\model;


class RepositoryFactory
{

    const CONFIG = [
        'article' => [
            'class' => 'Pierre\\model\\ArticleRepository',
        ],
    ];

    private static $instances = [];

    /**
     * @var \PDO
     */
    private $connector;

    public function __construct()
    {
        $this->connector = new \PDO(
            'mysql:dbname=cea;host=localhost',
            'root',
            'rootpass'
        );
    }

    public function get($repoName): EntityRepository
    {
        if (!key_exists($repoName, self::CONFIG)) {
            throw new \Exception();
        }

        if (!key_exists($repoName, self::$instances)) {
            $classname = self::CONFIG[$repoName]['class'];
            self::$instances[$repoName] =
                new $classname($this->connector)
            ;
        }

        return self::$instances[$repoName];
    }
}