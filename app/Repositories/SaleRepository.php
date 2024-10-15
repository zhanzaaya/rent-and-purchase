<?php

namespace App\Repositories;

use App\Models\Sale;

class SaleRepository
{
    public function createSale(int $userId, float $total)
    {
        return Sale::create([
            'user_id' => $userId,
            'total'   => $total,
        ]);
    }

    public function find(int $userId, int $productId)
    {
        return Sale::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();
    }
}
