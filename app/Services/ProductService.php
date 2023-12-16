<?php

namespace App\Services;

use App\Models\Product;

class ProductService {
    public function createProduct(array $data) {
        Product::create($data);
    }

    public function updateProduct(array $data, Product $product) {
        
    }
}
