<?php

namespace Birdder\Core;

class Router
{
    private $routes = [];

    private function splitUri($uri)
    {
            // $fristChar = substr($uri, 0, 1);
            $endChar = substr($uri, -1);
        
            return ($endChar === '/') ? substr($uri, 1, strlen($uri)-2) : substr($uri, 1);
    }
    
    public function getMethod()
    {
            return isset($_SERVER['REQUEST_METHOD']) ? strtolower($_SERVER['REQUEST_METHOD']) : 'cli';
    }
    
    public function getUri()
    {
        return $this->splitUri($_SERVER['REQUEST_URI']);
    }

    public function on(string $method, string $route, callable $callback)
    {
        $method = strtolower($method);
        if (!isset($this->routes[$method])) {
            $this->routes[$method] = [];
        }

        //$route = $this->splitUri($route);

        $this->routes[$method][$route] = $callback;

        return $this;
    }

    /*
    function run($method, $uri)
    {
        $method = strtolower($method);
        if (!isset($this->routes[$method])) {
            return null;
        }

        foreach ($this->routes[$method] as $route => $callback) {

            if (preg_match($route, $uri, $parameters)) {
                array_shift($parameters);
                return call_user_func_array($callback, $parameters);
            }
        }

        return null;
    }
    */

    function run($method, $uri)
    {
        $method = strtolower($method);
        if (!isset($this->routes[$method])) {
            return null;
        }

        $callback = $this->routes[$method][$uri];

        call_user_func_array($callback, array(/*params*/));
        return null;
    }

    public function dumpRoutes()
    {
        /*
        echo sizeof($this->routes) . '<br>';
        echo sizeof($this->routes['get']) . '<br>';
        echo sizeof($this->routes['put']) . '<br>';
        */
        foreach($this->routes as $number => $number_array)
        {
            foreach($number_array as $data => $user_data)
            {
                echo "Array number: $number, contains $data with .  <br>";
            }
        }
        
    }

}