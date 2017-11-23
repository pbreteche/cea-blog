<?php

namespace Pierre\model;


class ArticleRepository implements EntityRepository
{

    /**
     * @var \PDO
     */
    private $connector;

    public function __construct(\PDO $pdo)
    {
        $this->connector = $pdo;
    }

    public function findById(int $id)
    {

        $statement = $this->connector->prepare(
            'SELECT a.* FROM article a WHERE a.id = :id'
        );
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);

        $statement->setFetchMode(
            \PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE,
            Article::class,
            ['']
        );

        $statement->execute();

        $article = $statement->fetch();

        return $article;
    }

    public function findLatest($max = 30)
    {
        $statement = $this->connector->prepare(
            'SELECT * FROM article LIMIT :max'
        );
        $statement->bindValue(':max', $max, \PDO::PARAM_INT);


        $statement->execute();

        $articles = $statement->fetchAll(
            \PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE,
            Article::class,
            ['']
        );

        return $articles;
    }
}