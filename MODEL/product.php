<?php

spl_autoload_register(function ($class) {
    require __DIR__ . "/../COMMON/$class.php";
});

require __DIR__ . '/../vendor/autoload.php';

set_exception_handler("errorHandler::handleException");
set_error_handler("errorHandler::handleError");

class Product
{
    private $conn;
    private $table_name = "product";

    //private $id;
    //private $name;
    //private $description;
    //private $price;
    //private $quantity;
    //private $active;
    //private $ingredients = []; //id Ingredient
    //private $tags = []; //id Tag

    public function __construct($db) //Si connette al DB.
    {
        $this->db = new Connect;
        $this->conn = $this->db->getConnection();
    }
    
    public function getArchiveProduct() //Ritorna tutti i prodotti.
    {
        $query = 'SELECT * FROM ' . $this->table_name . ' p WHERE 1=1 ORDER BY p.name';

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function getProduct($id) //Ritorna il prodotto in base al suo id.
    {
        $query = 'SELECT * FROM ' . $this->table_name . ' p WHERE p.id = ' . $id;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function getProductAllergens($id) //Ritorna gli allergeni di un prodotto.
    {
        $query = 'SELECT DISTINCT a.id, a.name FROM ' . $this->table_name . ' p INNER JOIN product_ingredient pi ON p.id = pi.product INNER JOIN ingredient i ON pi.ingredient = i.id INNER JOIN ingredient_allergen ia ON i.id = ia.ingredient INNER JOIN allergen a ON ia.allergen = a.id WHERE p.id = ' . $id . ' ORDER BY a.name';
    
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function getProductIngredients($id) //Ritorna gli ingredienti di un prodotto.
    {
        $query = 'SELECT i.id, i.name, i.quantity FROM ' . $this->table_name . ' p INNER JOIN product_ingredient pi ON p.id = pi.product INNER JOIN ingredient i ON pi.ingredient = i.id WHERE p.id = ' . $id . ' ORDER BY i.name';
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function getProductTags($id) //Ritorna i tag di un prodotto.
    {
        $query = 'SELECT t.id, t.name FROM ' . $this->table_name . ' p INNER JOIN product_tag pt ON p.id = pt.product INNER JOIN tag t ON pt.tag = t.id WHERE p.id = ' . $id . ' ORDER BY t.name';
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function deleteProductFromAllIngredients($id) //Cancella il prodotto nella tabella molti a molti con gli ingredienti.
    {
        $query = 'DELETE FROM product_ingredient WHERE product = ' . $id;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    }

    public function deleteProductFromAllTags($id) //Cancella il prodotto nella tabella molti a molti con i tag.
    {
        $query = 'DELETE FROM product_tag WHERE product = ' . $id;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    }

    public function deleteProductFromAllOrders($id) //Cancella il prodotto nella tabella molti a molti con gli ordini.
    {
        $query = 'DELETE FROM product_order WHERE product = ' . $id;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    }

    public function deleteProductFromAllCarts($id) //Cancella il prodotto nella tabella molti a molti con i carrelli.
    {
        $query = 'DELETE FROM product_cart WHERE product = ' . $id;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    }

    public function deleteProduct($id) //Cancella il prodotto dalla tabella product.
    {
        $this->deleteProductFromAllIngredients($id); //Richiama il metodo per rimuovere il prodotto dalla tabella molti a molti (per permettermi poi di eliminarlo dalla tabella product).
        $this->deleteProductFromAllTags($id); //Richiama il metodo per rimuovere il prodotto dalla tabella molti a molti (per permettermi poi di eliminarlo dalla tabella product).
        $this->deleteProductFromAllOrders($id); //Richiama il metodo per rimuovere il prodotto dalla tabella molti a molti (per permettermi poi di eliminarlo dalla tabella product).
        $this->deleteProductFromAllCarts($id); //Richiama il metodo per rimuovere il prodotto dalla tabella molti a molti (per permettermi poi di eliminarlo dalla tabella product).
    
        $query = 'DELETE FROM ' . $this->table_name . ' WHERE id = ' . $id;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    }

    public function setProductIngredient($product_id, $ingredient_id) //Inserisce valori nella tabella product_ingredient.
    {
        $query = 'INSERT INTO product_ingredient (product, ingredient) VALUES(' . $product_id . ', ' . $ingredient_id . ')';

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    }

    public function setProductTag($product_id, $tag_id) //Inserisce valori nella tabella product_tag.
    {
        $query = 'INSERT INTO product_tag (product, tag) VALUES(' . $product_id . ', ' . $tag_id . ')';

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    }

    public function createProduct($name, $price, $description, $quantity, $active, $ingredients_ids, $tags_ids) //Inserisce un nuovo prodotto.
    {
        $query = 'INSERT INTO ' . $this->table_name . '(name, price, descpription, quantity, active) VALUES(\'' . $name . '\', ' . $price . ', \'' . $description . '\', ' . $quantity . ', ' . $active . ')';

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        if(count($ingredients_ids) > 0);
        {
            $query1 = 'SELECT DISTINCT id FROM ' . $this->table_name . ' WHERE name = \'' . $name . '\''; //Query per ritornarmi l'id dell'ingrediente.
            $stmt1 = $this->conn-> prepare($query1);
            $stmt1-> execute();
            $res = $stmt1->get_result();  
    
            for($i = 0; $i < count($ingredients_ids); $i++)
            {
                $this->setProductIngredient($res, $ingredients_ids[$i]);
            }
        }

        if(count($tags_ids) > 0);
        {
            $query1 = 'SELECT DISTINCT id FROM ' . $this->table_name . ' WHERE name = \'' . $name . '\''; //Query per ritornarmi l'id del tag.
            $stmt1 = $this->conn-> prepare($query1);
            $stmt1-> execute();
            $res = $stmt1->get_result();  
             
            for($i = 0; $i < count($tags_ids); $i++)
            {
                $this->setProductTag($res, $tags_ids[$i]);
            }
        }
    }

    public function modifyProductName($id, $name) //Modifica il nome di un prodotto.
    {
        $query = 'UPDATE ' . $this->table_name . ' p SET p.name = \'' . $name . '\' WHERE p.id = ' . $id; 

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    }

    public function modifyProductPrice($id, $price) //Modifica il prezzo di un prodotto.
    {
        $query = 'UPDATE ' . $this->table_name . ' p SET p.price = ' . $price . ' WHERE p.id = ' . $id; 

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    }

    public function modifyProductDescription($id, $description) //Modifica la descrizione di un prodotto.
    {
        $query = 'UPDATE ' . $this->table_name . ' p SET p.description = \'' . $description . '\' WHERE p.id = ' . $id; 

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    }


    public function modifyProductQuantity($id, $quantity) //Modifica la quantità in magazzino di un prodotto.
    {
        $query = 'UPDATE ' . $this->table_name . ' p SET p.quantity = ' . $quantity . ' WHERE p.id = ' . $id; 

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    }

    public function modifyProductActive($id, $active) //Modifica lo stato di un prodotto.
    {
        $query = 'UPDATE ' . $this->table_name . ' p SET p.quantity = ' . $active . ' WHERE p.id = ' . $id; 

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    }
}
?>