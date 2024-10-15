<?php

namespace App\Repositories;

use App\Models\DTO\ProductRentExtensionDto;
use App\Models\RentExtension;

class RentExtensionRepository
{
    public function createRentExtension(ProductRentExtensionDto $rentExtensionDto): RentExtension
    {
        return RentExtension::create([
            'rent_id'          => $rentExtensionDto->rent->id,
            'extension_period' => $rentExtensionDto->extensionPeriod,
            'total'            => $rentExtensionDto->getTotal(),
        ]);
    }
}
