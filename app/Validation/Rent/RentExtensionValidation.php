<?php

namespace App\Validation\Rent;

use App\Models\DTO\ProductRentExtensionDto;
use App\Models\Rent;
use App\Models\RentStatus;
use Illuminate\Validation\ValidationException;

class RentExtensionValidation
{
    public function validate(ProductRentExtensionDto $rentExtensionDto): void
    {
        if ($rentExtensionDto->rent->user_id !== $rentExtensionDto->user->id) {
            throw ValidationException::withMessages(['Action unauthorized']);
        }

        if ($rentExtensionDto->rent->status_id !== RentStatus::IN_PROGRESS) {
            throw ValidationException::withMessages(['Rent is not in progress']);
        }

        $rentExtensionDto->rent->loadSum('extensions', 'extension_period');
        if ($rentExtensionDto->rent->rent_period + $rentExtensionDto->rent->extensions_sum_extension_period + $rentExtensionDto->extensionPeriod > Rent::MAX_RENT_PERIOD) {
            throw ValidationException::withMessages(['Maximum total rent period is 24 hours']);
        }

        if ($rentExtensionDto->getTotal() > $rentExtensionDto->user->balance) {
            throw ValidationException::withMessages(['Not enough money for rent extension']);
        }
    }
}
