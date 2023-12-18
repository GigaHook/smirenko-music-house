<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductService {
    public function createProduct(array $data): void
    {
        $data['image'] = $this->uploadImage($data['image']);
        Product::create($data);
    }

    public function updateProduct(array $data, Product $product): void
    {
        //
    }

    private function uploadImage(mixed $image): string
    {
        $name = Str::uuid().'.'.$image->getClientOriginalExtension();
        Storage::disk('public')->put($name, file_get_contents($image));
        return $name;
    }
}
