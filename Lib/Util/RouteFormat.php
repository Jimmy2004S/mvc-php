<?php

namespace Lib\Util;

trait RouteFormat
{

    public function getRoute($uri)
    {
        foreach ($this->routes as $route => $details) {
            // Convertir la ruta con parámetros dinámicos a una expresión regular
            $pattern = preg_replace('#\{[^\}]+\}#', '([^/]+)', $route);
            $pattern = "#^" . $pattern . "$#";
            // Verificar si la URI coincide con el patrón
            if (preg_match($pattern, $uri, $matches)) {
                array_shift($matches); // Eliminar la coincidencia completa
                $params = [];
                // Extraer las claves de los parámetros dinámicos
                preg_match_all('#\{([^\}]+)\}#', $route, $paramKeys);
                // Asociar las claves con sus respectivos valores extraídos de la URI
                foreach ($paramKeys[1] as $index => $key) {
                    $params[$key] = $matches[$index];
                }
                // Devolver los detalles de la ruta y los parámetros extraídos
                return [$route, $details, $params];
            }
        }
        return null;
    }
}
