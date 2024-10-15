<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function subtractFromBalance(User $user, float $amountToSubtract): void
    {
        $user->update([
            'balance' => $user->balance - $amountToSubtract,
        ]);
    }
}
