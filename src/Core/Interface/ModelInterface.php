<?php

namespace Birdder\Core\Interface;

use Birdder\Core\Database\PostgreSQLConnection;

interface ModelInterface
{
    // Dependency injection: $connect
    public function __construct(PostgreSQLConnection $connection);
    public function insert(array $args);
    public function delete(int $id);
    public function get(int $id);
    public function findAll();

}