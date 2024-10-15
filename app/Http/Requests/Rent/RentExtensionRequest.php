<?php

namespace App\Http\Requests\Rent;

use Illuminate\Foundation\Http\FormRequest;

class RentExtensionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'rentId'          => 'required|int',
            'extensionPeriod' => 'required|int|in:4,8,12'
        ];
    }
}
