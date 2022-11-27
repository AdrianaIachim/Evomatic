<?php
class Staus
{
    private $conn;
    private $table_name = "status";

    private $id;
    private $description;

    public function __construct($db)
    {
        $this->conn = $db;
    }
}
?>
