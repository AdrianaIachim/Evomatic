<?php
class Pause
{
    private $conn;
    private $table_name = "break";

    private $id;
    private $time;
    private $pick_up; //id PickUp

    public function __construct($db)
    {
        $this->conn = $db;
    }
}
?>