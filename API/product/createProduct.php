<?php
    require __DIR__ . '/../../MODELS/product.php';

    $parts = explode("/", $_SERVER["REQUEST_URI"]);

    $product = new Product();

    $result = $product->createProduct($name, $price, $description, $quantity, $active, $ingredients_ids, $tags_ids);

    echo json_encode($result);