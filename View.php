<?php

class View
{
    /**
     * Data transferred to view
     */
    public static $data;

    public function __construct($view, $controller, $data = null)
    {
        self::$data = $data;
        require "View/{$controller}/{$view}View.php";
    }
}