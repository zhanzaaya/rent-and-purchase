<?php

namespace App\Repositories;

use App\Models\License;

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

    public function find(int $userId, int $productId)
    {
        return License::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();
    }
}
