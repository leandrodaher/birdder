<?php

use Birdder\Core\Router;


use Birdder\Core\Database\PostgreSQLConnection;
use Birdder\App\Models\Users;
use Birdder\App\Repository\UserRepository;
use Birdder\App\DAO\User;
use Birdder\App\Utils;

require_once '../config/database.php';

$router = new Router();

// $router
//     ->on('GET', '', function () {
//         echo "Nada??";
//         return 'Nada??';
//     })
//     ->on('GET', 'app/home', function () {
//         return 'Bem vindo(a)!';
//     })
//     ->on('GET', 'app/user', function () {
//         return 'this is a hero return';
//     })
//     ->on('GET', 'home/teste', function() {
//         echo "home";
//         return 'ok';   
//     })
//     ->on('PUT', 'eu/teste', function() {
//         echo "home";
//         return 'ok';   
//     })
//     ->on('PUT', 'voce/teste', function() {
//         echo "home";
//         return 'ok';   
//     });

// echo $router->dumpRoutes();
// echo '<br>';
// echo 'Method: ' . $router->getMethod();
// echo '<br>';
// echo 'URI: ' . $router->getUri();
// echo '<br>';
// echo '<br>';

$router
    ->on('GET', '', function () {
        echo "Nada??";
        return 'Nada??';
    })

    ->on('GET', 'user', function () {
       echo Router::getMethod() . ' | ' . Router::getUri();
    });


echo Router::getMethod() . ' | ' . Router::getUri();
$router->run(Router::getMethod(), Router::getUri());
