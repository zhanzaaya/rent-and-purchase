<?php

namespace App\Http\Requests\Rent;

use Illuminate\Foundation\Http\FormRequest;

class ProductRentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'rent_time_from' => 'required|date_format:Y-m-d H:i:s|after_or_equal:' . date('Y-m-d H:i:s'),
            'rent_period'    => 'required|int|in:4,8,12,24'
        ];
    }
}
