<?php

namespace Birdder\App\Models;

use Birdder\Core\Database\PostgreSQLConnection;
use Birdder\Core\Interface\ModelInterface;

// userid SERIAL
// username varchar(30)
// userpassword varchar(255)
// profilename varchar(40)
// profilebio varchar(140)

class Users // implements ModelInterface
{
    private $connection;

    // Dependency injection: $connect
    public function __construct(PostgreSQLConnection $connection)
    {
        $this->connection = $connection;
    }

    public function insert(string $name, string $password, string $profilename, string $profilebio): bool
    {
        return $this->connection->executeNonQuery("insert into users(username, userpassword, profilename, profilebio) values(?, ?, ?, ?)", array($name, $password, $profilename, $profilebio));
    }

    public function delete(int $id)
    {
        $sql = "delete from users 
                    where userid={$id}";

        return $this->connection->executeNonQuery($sql);
    }

    public function get(int $id)
    {
        $sql = "select * from users
                    where userid={$id}";

        return $this->connection->executeQuery($sql);
    }

    public function findAll()
    {
        return $this->connection->executeQuery("select * from users");
    }

    /*
    *   Esta query não faz sentido pois retorna muitos dados redundantes
    *   Talvez seja melhor fazer uma subquery
    *   Ou fazer duas queries: uma pra usuário e outra para posts relacionados a ele (no model Posts).
    */
    public function getUserJoinPosts(int $id)
    {
        $sql = "select * from users
                inner join posts using (userid)
                    where userid={$id}";
        return $this->connection->executeQuery($sql);
    }

}