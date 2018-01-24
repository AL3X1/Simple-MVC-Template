<?php
namespace Model;

require "./Model.php";

class UserModel extends \Model
{
    public function addUser($email)
    {
        $prepare = $this->pdo->prepare("INSERT INTO `users` SET `email` = :email");
        $prepare->bindParam(":email", $email);
        $prepare->execute();

        echo "user added";
    }
}