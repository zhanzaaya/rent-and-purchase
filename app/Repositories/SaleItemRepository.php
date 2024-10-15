<?php

namespace App\Repositories;

use App\Models\SaleItem;

class SaleItemRepository
{
    public function createSaleItem(int $saleId, int $productId, float $price, int $quantity)
    {
        return SaleItem::create([
            'sale_id'    => $saleId,
            'product_id' => $productId,
            'price'      => $price,
            'quantity'   => $quantity,
        ]);
    }
}
