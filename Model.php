<?php

class Model
{
    public $pdo;

    public function __construct($dbname, $username, $password)
    {
        $this->pdo = new PDO("mysql:host=localhost;dbname={$dbname};", $username, $password, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }
}