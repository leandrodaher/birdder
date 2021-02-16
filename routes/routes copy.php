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
        try {
            $db = new PostgreSQLConnection(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASS);
            $userModel = new Users($db);
            $userRepository = new UserRepository($userModel);
            Utils::printUsers($userRepository);
        } catch (Exception $e) {
            echo 'Erro! ' . $e->getMessage();
        }
    })
    ->on('GET', 'user/5', function () {
        try {
            $pg = PostgreSQLConnection::class;
            $db = new $pg(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASS);
            $userModel = new Users($db);
            $userRepository = new UserRepository($userModel);
            $user =  $userRepository->getUser(5);
            foreach ($user as $key => $value) {
                echo "{$key}: {$value}<br>";
            }
        } catch (Exception $e) {
            echo 'Erro! ' . $e->getMessage();
        }
    })
    ->on('GET', 'insert', function () {
        // try {
        //     $db = new PostgreSQLConnection(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASS);
        //     $userModel = new Users($db);

        //     // echo $userModel->insertUser('joao', 'j12', 'João Silva', 'Gosto de viver a vida.');
        //     $query = $userModel->findAll();
        //     Utils::printKeyValue($query); // call static method

        // } catch (Exception $e) {
        //     echo 'Erro! ' . $e->getMessage();
        // }
    });


$router->run(Router::getMethod(), Router::getUri());