<?php

namespace App\Validation\Rent;

use App\Models\Rent;
use App\Models\RentStatus;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class RentExtensionValidation
{
    public function validate(User $user, Rent $rent, int $rentExtensionPeriod): void
    {
        if ($rent->status_id !== RentStatus::IN_PROGRESS) {
            throw ValidationException::withMessages(['Rent is not in progress']);
        }

        $rent->loadSum('extensions', 'extension_period');
        if ($rent->rent_period + $rent->extensions_sum_extension_period > Rent::MAX_RENT_PERIOD) {
            throw ValidationException::withMessages(['Maximum total rent period is 24 hours']);
        }

        if ($rent->product_price * $rentExtensionPeriod > $user->balance) {
            throw ValidationException::withMessages(['Not enough money for rent extension']);
        }
    }
}
