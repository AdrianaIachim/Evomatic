<?php
class Product
{
    private $table_name;

    private $id;
    private $name;
    private $description;
    private $price;
    private $quantity;
    private $active;
    private $ingredients = []; //oggetto Ingredient
    private $tags = []; //oggetto Tag
}
?>