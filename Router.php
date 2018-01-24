<?php

class Router
{
    /**
     * URI data (www.domain.com/controller/action/params)
     */
    private static $requestData;

    public static function init()
    {
        self::$requestData = explode("/", $_SERVER["REQUEST_URI"]);
        self::CheckController();

        if (!empty(self::$requestData[2]))
        {
            self::CheckAction();
        }
        else if (empty(self::$requestData[2]) && !empty(self::$requestData[1]))
        {

            $filename = ucfirst(self::$requestData[1]) . "Controller.php";

            if (file_exists("Controller/{$filename}"))
                require "Controller/{$filename}";
            else
                return false;

            $className = "\\Controller\\" . ucfirst(self::$requestData[1]) . "Controller";
            $controller = new $className();

            if (method_exists($controller, "index"))
                $controller->index();
        }
    }

    /**
     * Checking request controller (www.domain.com/controller/)
     */
    private static function CheckController()
    {
        $dir = scandir("Controller");
        $requestController = strtolower(self::$requestData[1]);
        $method = "";

        foreach ($dir as $filename)
        {
            $shortControllerName = substr($filename, 0, strpos($filename, "Controller.php"));

            if ($requestController == strtolower($shortControllerName))
            {
                $method = strtolower($shortControllerName);
            }
            else if (empty($requestController))
            {
                require "Controller/IndexController.php";
                $oIndex = new \Controller\IndexController();

                if (method_exists($oIndex, "index"))
                    $oIndex->index();

                break;
            }
        }

        if (!empty($requestController)
            && $requestController != $method)
        {
            echo "Controller {$requestController} not found";
        }
    }

    /**
     * Checking action (www.domain.com/controller/action)
     */
    private static function CheckAction()
    {
        $requestAction = self::$requestData[2];
        $controllerName = ucfirst(self::$requestData[1]) . "Controller";
        $filename = "Controller/{$controllerName}.php";
        $className = "\\Controller\\" . $controllerName;

        if (file_exists($filename))
        {
            require $filename;
        }

        $controller = new $className();

        if (method_exists($controller, $requestAction))
        {
            $controller->$requestAction();
        }
        else
        {
            // TODO: Return 404
            echo "Method {$requestAction} not found.";
        }
    }
}