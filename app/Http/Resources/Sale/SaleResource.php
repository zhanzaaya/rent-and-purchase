<?php

namespace App\Http\Resources\Sale;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'sale_id' => $this->id,
            'user_id' => $this->user_id,
            'total'   => $this->total,
        ];
    }
}
