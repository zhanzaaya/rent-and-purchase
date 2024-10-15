<?php

namespace App\Models\DTO;

use App\Models\Product;
use App\Models\User;

class ProductRentDto
{
    public function __construct(
        public User $user,
        public Product $product,
        public string $rentTimeFrom,
        public string $rentPeriod,
        public int $quantity
    )
    {
    }

    public static function fromArray(array $data): static
    {
        return new static(
            user: auth()->user(),
            product: Product::findOrFail($data['productId']),
            rentTimeFrom: $data['rentTimeFrom'],
            rentPeriod: $data['rentPeriod'],
            quantity: $data['quantity'] ?? 1,
        );
    }

    public function getTotal(): float
    {
        return $this->product->hourly_rent_price * $this->rentPeriod * $this->quantity;
    }
}
