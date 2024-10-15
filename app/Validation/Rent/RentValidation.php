<?php

namespace App\Validation\Rent;

use App\Models\Product;
use App\Models\Rent;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class RentValidation
{
    public function validate(User $user, Product $product, string $rentTimeFrom, int $rentPeriod): void
    {
        // product in stock?
        if ($product->rental_stock_quantity < 1) {
            throw ValidationException::withMessages(['Product out of stock for rent']);
        }

        // revalidate rentTimeFrom
        if (Carbon::make($rentTimeFrom)->isPast()) {
            throw ValidationException::withMessages(['Invalid date and time of rent']);
        }

        // max rent time
        if ($rentPeriod > Rent::MAX_RENT_PERIOD) {
            throw ValidationException::withMessages(['Maximum total rent period is 24 hours']);
        }

        // user balance is enough
        if ($product->hourly_rent_price * $rentPeriod > $user->balance) {
            throw ValidationException::withMessages(['Not enough money for rent']);
        }
    }
}
