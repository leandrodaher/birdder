<?php

namespace Birdder\App\Models;

use Birdder\Core\Database\PostgreSQLConnection;
use Birdder\Core\Interface\ModelInterface;

// postid SERIAL
// content varchar(140)
// likes int
// userid int REF: Users

class Posts // implements ModelInterface
{
    private $connection;

    // Dependency injection: $connect
    public function __construct(PostgreSQLConnection $connection)
    {
        $this->connection = $connection;
    }

    public function insert(string $content, int $useridReference)
    {
        return $this->connection->executeNonQuery("insert into posts(content, likes, userid) values(?, 0, ?)", array($content, $useridReference));
    }

    public function delete(int $id)
    {
        $sql = "delete from posts 
                    where postid={$id}";

        return $this->connection->executeNonQuery($sql);
    }

    public function get(int $id)
    {
        $sql = "select * from posts
                    where postid={$id}";

        return $this->connection->executeQuery($sql);
    }

    public function findAll()
    {
        return $this->connection->executeQuery("select * from posts");
    }

    public function findAllByUser($userID)
    {
        $sql = "select * from posts
                    where userid={$userID}";
                    
        return $this->connection->executeQuery($sql);
    }

}