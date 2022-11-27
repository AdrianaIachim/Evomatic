<?php
class Order
{
    private $conn;
    private $table_name = "order";

    private $id;
    private $user; //id User
    private $cost;
    private $created_at;
    private $pick_up; //id PickUp
    private $break; //id Break (Pause)
    private $status; //id Status
    private $products = []; //id Product

    public function __construct($db)
    {
        $this->conn = $db;
    }
}
?>