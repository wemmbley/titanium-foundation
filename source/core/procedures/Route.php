<?php

namespace TitaniumFoundation\Core\Procedures;

use TitaniumFoundation\Core\Helpers\Path;

class Route
{
    /**
     * Контейнер публичных роутов.
     * Любой класс может посмотреть.
     *
     * Формат:
     * <code>
     *     $routes = [
     *         Type => [     // get, post, put, delete, any.
     *             [
     *                 URL => '',
     *                 Controller => MyController::class,
     *             ]
     *         ],
     *     ];
     * </code>
     *
     * @var array
     */
    public static array $routes = [];

    public static function get(string $route, array $controller): void
    {
        self::$routes['GET'][$route] = $controller;
    }

    public static function post(string $route, array $controller): void
    {
        self::$routes['POST'][$route] = $controller;
    }

    public static function put(string $route, array $controller): void
    {
        self::$routes['PUT'][$route] = $controller;
    }

    public static function delete(string $route, array $controller): void
    {
        self::$routes['DELETE'][$route] = $controller;
    }

    public static function any(string $route, array $controller): void
    {
        self::$routes['ANY'][$route] = $controller;
    }

    public static function boot(): void
    {
        self::urlToController($_SERVER['REQUEST_URI'], self::$routes);
    }

    public static function loadDefaultRoutes(): void
    {
        $projectsDir = Path::root('projects');
        $projects = Path::scan($projectsDir);

        foreach ($projects as $project) {
            $routeFile = Path::root('projects/' . $project . '/client/routes.php');

            if(file_exists($routeFile)) {
                require_once $routeFile;
            }
        }
    }

    private static function urlToController(string $currentUrl, array $routes)
    {
        // Крутим все роуты доступные.
        foreach($routes as $methods => $urls)
        {
            foreach($urls as $url => $controller)
            {
                // Совпадение текущего УРЛа с тем что есть в контейнере.
                if($url === $currentUrl) {

                    // Вызываем инстанс необходимый и его метод.
                    $controllerInstance = new $controller[0];
                    $controllerProcedure = $controllerInstance->{$controller[1]}();

                    return $controllerProcedure;
                }
            }
        }
    }
}