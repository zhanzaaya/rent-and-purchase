<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function reduceProductStock(Product $product, int $quantity)
    {
        $product->update([
            'stock_quantity' => $product->stock_quantity - $quantity,
        ]);
    }

    public function reduceProductRentalStock(Product $product, int $quantity)
    {
        $product->update([
            'rental_stock_quantity' => $product->rental_stock_quantity - $quantity,
        ]);
    }
}
