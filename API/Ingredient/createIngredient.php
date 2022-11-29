<?php
require __DIR__ . '/../../MODEL/ingredient.php';

$parts = explode("/", $_SERVER["REQUEST_URI"]);

$ingredient = new Ingredient;

$result = $ingredient->createIngredient($name, $description, $prize, $quantity, $allergens_ids);

echo json_encode($result);
?>