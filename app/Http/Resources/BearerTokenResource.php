<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class BearerTokenResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'token' => $this->plainTextToken,
            'type' => 'Bearer',
            'header' => [
                'name' => 'Authorization',
                'value' => 'Bearer ' . $this->plainTextToken,
            ]
        ];
    }
}
