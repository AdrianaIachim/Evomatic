<?php
Class Tag
    {
        protected $conn;
        protected $table_name = "tag";

        protected $tag_ID;
        protected $tag;

        public function __construct($db)
        {
            $this -> conn = $db;
        }

        function createTag($tag)
        {
            $query = "INSERT INTO $this -> table_name (tag) VALUES (?)";   
            $stmt = $this -> conn -> prepare($query);

            $stmt->bind_param('i', $this -> tag); 
            $stmt->execute();
        }

        function getTag($tag_ID)
        {
            $query = "SELECT * FROM $this -> table_name WHERE ID = $tag_ID";
            $stmt = $this -> conn -> prepare($query);
            return $stmt;
        }

            foreach(json_decode($products, true) as $product)
            {
                $stmt->bind_param('iii', $order_ID, $product['ID'], $product['quantity']); // lega i parametri alla query e le dice quali sono i paramentri
            foreach(json_decode($products, true) as $product)
            {
                $stmt->bind_param('iii', $order_ID, $product['ID'], $product['quantity']); // lega i parametri alla query e le dice quali sono i paramentri
                $stmt->execute();
            }
        }
    ?>

