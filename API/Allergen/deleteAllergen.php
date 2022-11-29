<?php
require __DIR__ . '/../../MODEL/allergen.php';

$parts = explode("/", $_SERVER["REQUEST_URI"]);

$allergen = new Allergen;

$result = $allergen->deleteAllergen($id);

echo json_encode($result);
?>