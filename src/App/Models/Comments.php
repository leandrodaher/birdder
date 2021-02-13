<?php

namespace Birdder\App\Models;

use Birdder\Core\Database\PostgreSQLConnection;
use Birdder\Core\Interface\ModelInterface;

// commentid SERIAL
// content varchar(140)
// postid int REF: Posts

class Comments // implements ModelInterface
{
    private $connection;

    // Dependency injection: $connect
    public function __construct(PostgreSQLConnection $connection)
    {
        $this->connection = $connection;
    }

    public function insert(string $content, int $postidReference)
    {
        return $this->connection->executeNonQuery("insert into comments(content, postidReference) values(?, ?)", array($content, $postidReference));
    }

    public function delete(int $id)
    {
        $sql = "delete from comments 
                    where commentid={$id}";

        return $this->connection->executeNonQuery($sql);
    }

    public function get(int $id)
    {
        $sql = "select * from comments
                    where commentid={$id}";

        return $this->connection->executeQuery($sql);
    }

    public function findAll()
    {
        return $this->connection->executeQuery("select * from comments");
    }

    public function findAllByPosts($postID)
    {
        $sql = "select * from comments
                    where postid={$postID}";
                    
        return $this->connection->executeQuery($sql);
    }

}