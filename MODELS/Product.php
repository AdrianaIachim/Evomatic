<?php
class Product
{
  //DB Related
   private $conn;
   private $table = "product";
  
  //Properties
  public $id;
  public $name;
  public $ingredients;
  public $description;
  public $prize;
  
  //Construct with Db
    public function __construct($db)
    {
        $this->conn = $db;
    }
}
?>
