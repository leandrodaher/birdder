<?php

function getMethod()
{
    return isset($_SERVER['REQUEST_METHOD']) ? strtolower($_SERVER['REQUEST_METHOD']) : 'cli';
}

function getRoute($value)
{
    $fristChar = substr($value, 0, 1);
    $endChar = substr($value, -1);
   
    return ($endChar === '/') ? substr($value, 1, strlen($value)-2) : substr($value, 1);
}

$route = $_SERVER['REQUEST_URI'];

$route = getRoute($route);
echo substr($_SERVER['REQUEST_URI'], 0,1);
echo 'Rota completa: ' . $route;
echo '<br>';

echo 'Strlen ' . strlen($route);
echo '<br>';

echo 'Explode ' . var_dump(explode('/', $route));
echo '<br>';

echo 'Rota: ' . $route;
echo '<br>';

echo 'Método: ' . getMethod();