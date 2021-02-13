<?php

namespace Birdder\Core\Interface;

use \PDO;

interface ConnectionInterface
{
    public function __construct(string $host, string $port, string $dbname, string $user, string $password);
    public function getPDO(): PDO;
    public function connect(): ConnectionInterface;
    public function disconnect(): ConnectionInterface;
    public function executeQuery(string $sql, array $params = null);
}