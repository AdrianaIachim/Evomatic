<?php
require __DIR__ . '/../../MODEL/ingredient.php';

$parts = explode("/", $_SERVER["REQUEST_URI"]);

$ingredient = new Ingredient;

$result = $ingredient->getIngredientAllergens($id);

echo json_encode($result);
?>