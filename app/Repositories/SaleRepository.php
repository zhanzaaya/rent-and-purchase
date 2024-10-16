<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\Sale;

class SaleRepository
{
    public function createSale(int $userId, Product $product)
    {
        return Sale::create([
            'user_id' => $userId,
            'product_id' => $product->id,
            'price' => $product->price,
            'total'   => $product->price,
        ]);
    }

    public function find(int $userId, int $productId)
    {
        return Sale::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();
    }
}
