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
            'login' => [
                'controller' => 'SessionController',
                'method' => 'loginView'
            ],
            'inicio' => [
                'controller' => 'HomeController',
                'method' => 'inicioView'
            ],
            'posts/tendencias' => [
                'controller' => 'HomeController',
                'method' => 'inicioView'
            ],
            'user/posts' => [
                'controller' => 'PostsController',
                'method' => 'verMisPostsView'
            ],
            'admin/inicio' => [
                'controller' => 'AdminController',
                'method' => 'inicioView'
            ],
            'admin/users' => [
                'controller' => 'AdminController',
                'method' => 'verUsuariosView'
            ],
        ];
    }
}
