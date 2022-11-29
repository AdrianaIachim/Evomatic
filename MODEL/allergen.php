<?php

spl_autoload_register(function ($class) {
    require __DIR__ . "/../COMMON/$class.php";
});

require __DIR__ . '/../vendor/autoload.php';

set_exception_handler("errorHandler::handleException");
set_error_handler("errorHandler::handleError");

class Allergen
{
    private $conn;
    private $table_name = "allergen";

    //private $id;
    //private $name;

    public function __construct()
    {
        $this->db = new Connect;
        $this->conn = $this->db->getConnection();
    }

    public function getArchiveAllergen() //Ritorna tutti gli allergeni.
    {
        $query = 'SELECT * FROM ' . $this->table_name . ' a WHERE 1=1 ORDER BY a.name';

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function getAllergen($id) //Ritorna l'allergene in base al suo id.
    {
        $query = 'SELECT * FROM ' . $this->table_name . ' a WHERE a.id = ' . $id;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function deleteAllergenFromAllIngredients($id) //Cancella l'allergene nella tabella molti a molti.
    {
        $query = 'DELETE FROM ingredient_allergen WHERE allergen = ' . $id;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    }

    public function deleteAllergen($id) //Cancella l'allergene dalla tabella allergen.
    {
        $this->deleteAllergenFromAllIngredients($id); //Richiama il metodo per rimuovere l'allergene dalla tabella molti a molti (per permettermi poi di eliminarla dalla tabella allergen).
        
        //$query = 'DELETE a, ia FROM' . $this-> table_name . ' a INNER JOIN ingredients_allergens ia ON a.id = ia.allergens_id WHERE a.id = ' . $id;
        $query = 'DELETE FROM ' . $this->table_name . ' WHERE id = ' . $id;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    }

    public function createAllergen($name) //Inserisce nella tabella un nuovo allergene.
    {
        $query = 'INSERT INTO ' . $this->table_name . '(name) VALUES(\'' . $name . '\')';

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    }

    public function modifyAllergenName($id, $name) //Modifica il nome di un allergene.
    {
        $query = 'UPDATE ' . $this->table_name . ' a SET a.name = \'' . $name . '\' WHERE a.id = ' . $id; 

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    }
}
?>
