<?php
class Tag
{
    private $conn;
    private $table_name = "tag";

    private $id;
    private $name;

    public function __construct($db)
    {
        $this->conn = $db;
    }
}
?>