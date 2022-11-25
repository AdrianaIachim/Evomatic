<?php
class Tag
{
    protected $conn;
    protected $table_name = "tag";

    protected $tag_ID;
    protected $tag;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function createTag($tag)
    {
        $query = "INSERT INTO $this -> table_name (tag) VALUES (?)";
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param('i', $this->tag);
        $stmt->execute();
    }

    function getTag($tag_ID)
    {
        $query = "SELECT * FROM $this -> table_name WHERE ID = $tag_ID";
        $stmt = $this->conn->prepare($query);
        return $stmt;
    }
}
?>
