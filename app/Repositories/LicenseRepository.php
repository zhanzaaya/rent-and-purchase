<?php

namespace App\Repositories;

use App\Models\License;
use App\Models\Rent;
use App\Models\Sale;

class LicenseRepository
{
    public function create(int $userId, int $productId, ?string $expiresAt = null)
    {
        return License::create([
            'user_id'    => $userId,
            'product_id' => $productId,
            'key'        => hash('sha256', $userId . $productId),
            'expires_at' => $expiresAt ?: null,
        ]);
    }

    public function createFromSale(int $userId, int $productId, Sale $sale)
    {
        return License::create([
            'user_id'         => $userId,
            'product_id'      => $productId,
            'key'             => hash('sha256', $userId . $productId),
            'licensable_id'   => $sale->id,
            'licensable_type' => Sale::class,
            'expires_at'      => null,
        ]);
    }

    public function createFromRent(int $userId, int $productId, Rent $rent)
    {
        return License::create([
            'user_id'         => $userId,
            'product_id'      => $productId,
            'key'             => hash('sha256', $userId . $productId),
            'licensable_id'   => $rent->id,
            'licensable_type' => Rent::class,
            'expires_at'      => $rent->rent_time_from->addHours($rent->rent_period),
        ]);
    }

    public function find(int $userId, int $productId)
    {
        return License::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();
    }
}
