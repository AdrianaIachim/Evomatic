<?php
require __DIR__ . '/../../MODEL/ingredient.php';

$parts = explode("/", $_SERVER["REQUEST_URI"]);

$ingredient = new Ingredient;

$result = $ingredient->modifyIngredientName($id, $name);

echo json_encode($result);
?>