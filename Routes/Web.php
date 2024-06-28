<?php

namespace Routes;
use Lib\Util\RouteFormat;
class Web
{

    use RouteFormat;
    private $routes = [];

    public function __construct()
    {
        $this->routes = [
            'inicio' => [
                'controller' => 'HomeController',
                'method' => 'inicioView'
            ],
            'posts/tendencias' => [
                'controller' => 'HomeController',
                'method' => 'inicioView'
            ]
        ];
    }
}
