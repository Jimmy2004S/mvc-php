<?php

namespace Routes;

class Web
{
    private $routes = [];

    public function __construct()
    {
        $this->routes = [
            'inicio' => [
                'controller' => 'HomeController',
                'method' => 'inicioView'
            ],
            'login' => [
                'controller' => 'SessionController',
                'method' => 'login'
            ],
            'logout' => [
                'controller' => 'SessionController',
                'method' => 'logout'
            ],
            'logueado' => [
                'controller' => 'SessionController',
                'method' => 'logueado'
            ],
            'users' => [
                'controller' => 'AdminController',
                'method' => 'verUsuarios'
            ],
            'posts' => [
                'controller' => 'PostsController',
                'method' => 'verPosts'
            ],
            'posts/tendencias' => [
                'controller' => 'PostsController',
                'method' => 'verPostsTendencias'
            ],
            'posts/files' => [
                'controller' => 'PostsController',
                'method' => 'listarFilesPosts'
            ],
            'like' => [
                'controller' => 'LikeController',
                'method' => 'like'
            ]
        ];
    }

    public function getRoute($uri)
    {
        $cleanUri = $this->cleanUri($uri);
        return $this->routes[$cleanUri] ?? null;
    }

    private function cleanUri($uri)
    {
        $uriParts = explode('?', $uri);
        return $uriParts[0];
    }
}
