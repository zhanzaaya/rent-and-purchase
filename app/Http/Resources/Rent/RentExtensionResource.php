<?php

namespace App\Http\Resources\Rent;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RentExtensionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'rent_id'          => $this->rent_id,
            'extension_period' => $this->extension_period,
            'total'            => $this->total,
        ];
    }
}
