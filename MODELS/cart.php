<?php
class Cart
{
    private $conn;
    private $table_name = "cart";

    private $id;
    private $user; //id User
    private $products = []; //id Product

    public function __construct($db)
    {
        $this->conn = $db;
    }
}
?>