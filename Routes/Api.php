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
            'api/user/create' => [
                'controller' => 'SessionController',
                'method' => 'register'
            ],
            'api/users' => [
                'controller' => 'AdminController',
                'method' => 'verUsuarios'
            ],
            'api/user/{user_id}/state' => [
                'controller' => 'AdminController',
                'method' => 'cambiarEstadoUsuario'
            ],
            'api/user/posts' => [
                'controller' => 'PostsController',
                'method' => 'verMisPosts'
            ],
            'api/user/post/{post_id}' => [
                'controller' => 'PostsController',
                'method' => 'verPost'
            ],
            'api/post/create' => [
                'controller' => 'PostsController',
                'method' => 'crearPost'
            ],
            'api/posts' => [
                'controller' => 'PostsController',
                'method' => 'verPosts'
            ],
            'api/posts/trends' => [
                'controller' => 'PostsController',
                'method' => 'verPostsTendencias'
            ],
            'api/post/{post_id}/files' => [
                'controller' => 'FileController',
                'method' => 'listarFilesPost'
            ],
            'api/post/{post_id}/like' => [
                'controller' => 'LikeController',
                'method' => 'like'
            ],
            'api/post/{post_id}/delete' => [
                'controller' => 'PostsController',
                'method' => 'eliminarPost'
            ]
        ];
    }
}
