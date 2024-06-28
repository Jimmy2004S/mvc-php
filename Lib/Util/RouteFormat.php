<?php
namespace Lib\Util;

trait RouteFormat{

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