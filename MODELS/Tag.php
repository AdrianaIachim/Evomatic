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
            $query = "INSERT INTO $this -> table_name (tag_ID, tag) VALUES (?, ?)";   
            $stmt = $this -> conn -> prepare($query);

            $stmt->bind_param('ii', $this -> tag_ID, $this -> tag); 
            $stmt->execute();
        }

        function getTag($tag_ID)
        {
            $query = "SELECT * FROM $this -> table_name WHERE ID = $tag_ID";
            $stmt = $this -> conn -> prepare($query);
            return $stmt;
        }
        /*
        function setOrderProduct($order_ID, $products) // setta i prodotti di un determinato ordine
        {
            $query = "INSERT INTO $this->table_name (order_ID, product_ID, quantity) VALUES (?, ?, ?)";
            $stmt = $this->conn->prepare($query);

            foreach(json_decode($products, true) as $product)
            {
                $stmt->bind_param('iii', $order_ID, $product['ID'], $product['quantity']); // lega i parametri alla query e le dice quali sono i paramentri
                $stmt->execute();
            }
        }

        function getOrderProduct($order_ID) // Ottiene i record della tabella order_product che hanno come order_ID quello passato alla funzione
        {
            $query = "SELECT * FROM $this->table_name WHERE order_ID = $order_ID";

            $stmt = $this->conn->query($query);

            return $stmt;
        }*/
    }
    ?>
