<?php
/**
 * Created by PhpStorm.
 * Date: 2017-02-04
 * Time: 13:56
 */

namespace app\components;

/**
 * Class Router
 * @package app\components
 */
class Router
{
    /**
     * Default controller/action
     *
     * @var string
     */
    private $defaultController = 'site';
    private $defaultAction     = 'index';

    /**
     * Controller folder
     *
     * @var string
     */
    private $controllerFolder = 'controllers';

    /**
     * Run app
     *
     * @return string
     */
    public static function run(): string
    {
        $request_url = explode('?', $_SERVER['REQUEST_URI'], 2);

        $request = explode('/', $request_url[0] ?? $request_url);

        if (is_array($request)) {
            $request = array_values(array_filter($request));
        }

        $instance = new self();

        $controller = $request[0] ?? $instance->defaultController;
        $action     = $request[1] ?? $instance->defaultAction;

        if (empty($controller) && !$instance->getControllerClassName($controller)) {
            exit('Page not found.');
        }

        $controllerInstance = $instance->getControllerClassName($controller);
        /** @var BaseController $commonController */
        $commonController   = (new $controllerInstance($instance->getControllerID($controller), $action));

        return $commonController->run();
    }

    /**
     * Get controller class name
     *
     * @param string|null $name
     * @return string
     */
    private function getControllerClassName(string $name = null): string
    {
        $name = $this->getControllerID($name);

        $controller = 'app\\'.$this->controllerFolder.'\\'.ucfirst($name).'Controller';

        if (class_exists($controller)) {
            return $controller;
        }

        return null;
    }

    /**
     * Get controller id
     *
     * @param string|null $name
     * @return string
     */
    private function getControllerID(string $name = null): string
    {
        if (empty($name)) {
            $name = $this->defaultController;
        }

        return strtolower($name);
    }
}