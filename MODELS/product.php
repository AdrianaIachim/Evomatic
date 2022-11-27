<?php
class Product
{
    private $conn;
    private $table_name = "product";

    private $id;
    private $name;
    private $description;
    private $price;
    private $quantity;
    private $active;
    private $ingredients = []; //id Ingredient
    private $tags = []; //id Tag

    public function __construct($db)
    {
        $this->conn = $db;
    }
}
?>