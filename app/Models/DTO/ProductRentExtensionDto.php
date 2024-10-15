<?php

namespace App\Models\DTO;

use App\Models\Rent;
use App\Models\User;

class ProductRentExtensionDto
{
    public function __construct(
        public User $user,
        public Rent $rent,
        public int $extensionPeriod
    )
    {
    }

    public static function fromArray(array $data): static
    {
        return new static(
            user: auth()->user(),
            rent: Rent::findOrFail($data['rentId']),
            extensionPeriod: $data['extensionPeriod']
        );
    }

    public function getTotal(): float
    {
        return $this->rent->product_price * $this->rent->quantity * $this->extensionPeriod;
    }
}
