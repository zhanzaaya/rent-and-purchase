<?php

namespace App\Repositories;

use App\Models\DTO\ProductRentDto;
use App\Models\Rent;
use App\Models\RentStatus;

class RentRepository
{
    public function createRent(ProductRentDto $rentDto)
    {
        return Rent::create([
            'user_id' => $rentDto->user->id,
            'product_id' => $rentDto->product->id,
            'status_id' => RentStatus::IN_PROGRESS,
            'rent_time_from' => $rentDto->rentTimeFrom,
            'rent_period' => $rentDto->rentPeriod,
            'product_price' => $rentDto->product->hourly_rent_price,
            'quantity' => $rentDto->quantity,
            'total' => $rentDto->getTotal(),
        ]);
    }
}
