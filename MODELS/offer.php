<?php
class Offer
{
    private $conn;
    private $table_name = "offer";

    private $id;
    private $product; //id Product
    private $price;
    private $expiry;
    private $description;

    public function __construct($db)
    {
        $this->conn = $db;
    }
}
?>