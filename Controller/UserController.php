<?php

namespace Controller;

require "./Model/UserModel.php";
require "./View.php";

class UserController
{
    private $model;

    public function __construct()
    {
        $this->model = new \Model\UserModel("test", "root", "");
    }

    public function index()
    {
        return new \View("Main", "User");
    }

    public function add()
    {
        if (isset($_POST["email"]))
        {
            $this->model->addUser($_POST["email"]);
        }

        return new \View("Main", "User");
    }
}