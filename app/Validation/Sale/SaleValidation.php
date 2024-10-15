<?php

namespace App\Validation\Sale;

use App\Models\Product;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class SaleValidation
{
    public function validate(User $user, Product $product): void
    {
        if ($product->price > $user->balance) {
            throw ValidationException::withMessages(['Not enough money for purchase']);
        }

        if ($product->stock_quantity < 1) {
            throw ValidationException::withMessages(['Product out of stock for purchase']);
        }
    }
}
