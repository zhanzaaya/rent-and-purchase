<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LicenseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        if (is_null($this->resource)) {
            return [
                'status' => 'none',
                'key' => null,
            ];
        }

        return [
            'status' => strtolower(class_basename($this->licensable_type)),
            'key' => $this->key,
        ];
    }
}
