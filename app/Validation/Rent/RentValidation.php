<?php

namespace App\Validation\Rent;

use App\Models\DTO\ProductRentDto;
use App\Models\Rent;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class RentValidation
{
    public function validate(ProductRentDto $rentDto): void
    {
        // product in stock?
        if ($rentDto->product->rental_stock_quantity < 1) {
            throw ValidationException::withMessages(['Product out of stock for rent']);
        }

        // revalidate rentTimeFrom
        if (Carbon::make($rentDto->rentTimeFrom)->isPast()) {
            throw ValidationException::withMessages(['Invalid date and time of rent']);
        }

        // max rent period
        if ($rentDto->rentPeriod > Rent::MAX_RENT_PERIOD) {
            throw ValidationException::withMessages(['Maximum total rent period is 24 hours']);
        }

        // user balance is enough
        if ($rentDto->product->hourly_rent_price * $rentDto->rentPeriod > $rentDto->user->balance) {
            throw ValidationException::withMessages(['Not enough money for rent']);
        }
    }
}
