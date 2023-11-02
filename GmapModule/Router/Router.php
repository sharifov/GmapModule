<?php

namespace GmapModule\Router;

use GmapModule\System\IController;

class Router implements IRouter
{
    /** @var string */
    private const DEFAULT_CONTROLLER = 'Start';

    /** @var string */
    private const DEFAULT_ACTION = 'Index';

    /** @var string */
    private const CONTROLLER_POSTFIX = 'Controller';

    private string $controllerName;

    private string $actionName;

    /** @var string[] */
    private array $params = [];

    private IController $controller;

    public function __construct()
    {
        $routes = explode('/', str_replace(
            ['?', $_SERVER['QUERY_STRING']],
            '',
            trim($_SERVER['REQUEST_URI'], '/')
        ));

        if (empty($routes[0])) {
            $routes[0] = self::DEFAULT_CONTROLLER;
        }

        $this->controllerName = ucfirst(strtolower($routes[0])) . self::CONTROLLER_POSTFIX;

        if (empty($routes[1])) {
            $routes[1] = self::DEFAULT_ACTION;
        }

        $this->actionName = strtolower($routes[1]);

        if (count($routes) > 2) {
            $this->params = array_slice($routes, 2);
        }

        //$controllerPath = DIR_CONTROLLER . $this->controllerName . '.php';

//        if (file_exists($controllerPath)) {
//            require_once $controllerPath;
//        } else {
//            throw new InvalidArgumentException('Невозможно найти класс контроллера!');
//        }
        $this->controller = new $this->controllerName();
    }

    public function getController(): IController
    {
        return $this->controller;
    }

    public function getControllerName(): string
    {
        return $this->controllerName;
    }

    public function getActionName(): string
    {
        return $this->actionName;
    }

    /** @inheritdoc */
    public function getParams(): array
    {
        return $this->params;
    }
}