<?php
class PickUp
{
    private $conn;
    private $table_name = "pickup";

    private $id;
    private $name;

    public function __construct($db)
    {
        $this->conn = $db;
    }
}
?>