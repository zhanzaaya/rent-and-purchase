<?php

namespace App\Http\Resources\Rent;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'rent_id'         => $this->id,
            'product_id'      => $this->product_id,
            'user_id'         => $this->user_id,
            'total'           => $this->total,
            'status_id'       => $this->status_id,
            'rent_time_from'  => $this->rent_time_from,
            'rent_period'     => $this->rent_period,
            'product_price'   => $this->product_price,
            'rent_extensions' => RentExtensionResource::collection($this->whenLoaded('extensions')),
        ];
    }
}
