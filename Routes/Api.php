<?php
namespace Routes;

use Lib\Util\RouteFormat;

class Api
{
    use RouteFormat;
    private $routes = [];

    public function __construct()
    {
        $this->routes = [
            'api/login' => [
                'controller' => 'SessionController',
                'method' => 'login'
            ],
            'api/logout' => [
                'controller' => 'SessionController',
                'method' => 'logout'
            ],
            'api/logueado' => [
                'controller' => 'SessionController',
                'method' => 'logueado'
            ],
            'api/users' => [
                'controller' => 'AdminController',
                'method' => 'verUsuarios'
            ],
            'api/users/state' => [
                'controller' => 'AdminController',
                'method' => 'cambiarEstadoUsuario'
            ],
            'api/posts' => [
                'controller' => 'PostsController',
                'method' => 'verPosts'
            ],
            'api/posts/trends' => [
                'controller' => 'PostsController',
                'method' => 'verPostsTendencias'
            ],
            'api/posts/files' => [
                'controller' => 'PostsController',
                'method' => 'listarFilesPosts'
            ],
            'api/like' => [
                'controller' => 'LikeController',
                'method' => 'like'
            ]
        ];
    }
}
