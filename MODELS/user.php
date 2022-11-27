<?php
class User
{
    private $conn;
    private $table_name = "user";

    private $id;
    private $name;
    private $surname;
    private $email;
    private $password;
    private $active;
    private $favourites = [];

    public function __construct($db)
    {
        $this->conn = $db;
    }
}
?>