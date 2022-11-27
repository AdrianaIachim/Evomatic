<?php
class Reset
{
    private $conn;
    private $table_name = "reset";

    private $id;
    private $user; //id User
    private $password;
    private $requested;
    private $expires;
    private $completed;

    public function __construct($db)
    {
        $this->conn = $db;
    }
}
?>