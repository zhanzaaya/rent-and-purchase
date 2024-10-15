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
}
