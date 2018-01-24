<?php

namespace Controller;
require "View.php";

class IndexController
{
    public function index()
    {
        return new \View("Index", "Index", ["class_name" => "Main Class"]);
    }
}