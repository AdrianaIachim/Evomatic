<?php
require __DIR__ . '/../../MODEL/ingredient.php';

$parts = explode("/", $_SERVER["REQUEST_URI"]);

$ingredient = new Ingredient;

$result = $ingredient->modifyIngredientQuantity($id, $quantity);

echo json_encode($result);
?>