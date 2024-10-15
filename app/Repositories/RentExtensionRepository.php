<?php

namespace App\Repositories;

use App\Models\Rent;
use App\Models\RentExtension;

class RentExtensionRepository
{
    public function createRentExtension(Rent $rent, int $rentExtensionPeriod, float $rentExtensionTotal): RentExtension
    {
        return RentExtension::create([
            'rent_id'          => $rent->id,
            'extension_period' => $rentExtensionPeriod,
            'total'            => $rentExtensionTotal
        ]);
    }
}
