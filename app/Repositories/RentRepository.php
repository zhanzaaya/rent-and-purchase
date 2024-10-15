<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\Rent;
use App\Models\RentStatus;
use App\Models\User;

class RentRepository
{
    public function createRent(User $user, Product $product, string $rentTimeFrom, int $rentPeriod, int $quantity)
    {
        return Rent::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'status_id' => RentStatus::IN_PROGRESS,
            'rent_time_from' => $rentTimeFrom,
            'rent_period' => $rentPeriod,
            'product_price' => $product->hourly_rent_price,
            'quantity' => $quantity,
            'total' => $product->hourly_rent_price * $rentPeriod * $quantity,
        ]);
    }
}
