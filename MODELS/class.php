<?php
class Mates
{
    private $conn;
    private $table_name = "class";

    private $id;
    private $year;
    private $section;
    private $users = []; //id User

    public function __construct($db)
    {
        $this->conn = $db;
    }
}
?>