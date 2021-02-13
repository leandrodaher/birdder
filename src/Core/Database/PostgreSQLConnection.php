<?php

/*
 *
 *  Lembre-se de habilitar a linha "extension=php_pdo_pgsql.dll" do seu php.ini
 * 
*/

namespace Birdder\Core\Database;

use Birdder\Core\Interface\ConnectionInterface;
use \Exception;
use \PDO;

class PostgreSQLConnection implements ConnectionInterface
{
    private $pdo;
    private string $host;
    private string $port;
    private string $dbname;
    private string $user;
    private string $password;

    public function __construct(string $host, string $port, string $dbname, string $user, string $password)
    {
        $this->host = $host;
        $this->port = $port;
        $this->dbname = $dbname;
        $this->user = $user;
        $this->password = $password;

        $this->connect();
    }

    public function getPDO(): PDO
    {
        return $this->pdo;
    }

    public function connect(): ConnectionInterface
    {
        if ($this->pdo == null) {
            try {
                $this->pdo = new PDO("pgsql:host={$this->host};dbname={$this->dbname}",
                $this->user, $this->password);
            } catch(Exception $e) {
                throw $e;

                return null;
            }
            
        }

        return $this;
    }

    public function disconnect(): ConnectionInterface
    {
        $this->pdo = null;

        return $this;
    }

    // Retorna resultado da query (select)
    public function executeQuery(string $sql, array $values = null)
    {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($values);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (\PDOException $exception) {
            throw $exception; //rethrow PDOException

            return null;
        }
    }

    // Retorna se execução foi bem sucedida
    // Exemplo:
    // $sql = "insert into produtos(descrição, valor) values(?, ?)"
    // $values = array('Smartphone PHP', '20')
    public function executeNonQuery(string $sql, array $values = null): bool
    {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($values);

            return true;
            
        } catch (\PDOException $exception) {
            throw $exception; //rethrow PDOException

            return false;
        }
    }
}