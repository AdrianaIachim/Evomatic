<?php
    require __DIR__ . '/../../MODELS/product.php';

    $parts = explode("/", $_SERVER["REQUEST_URI"]);

    $product = new Product();

    $result = $product->modifyProductPrice($id,$price);

    echo json_encode($result);