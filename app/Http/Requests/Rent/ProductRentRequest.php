<?php

namespace App\Http\Requests\Rent;

use Illuminate\Foundation\Http\FormRequest;

class ProductRentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'productId'    => 'required|int',
            'rentTimeFrom' => 'required|date_format:Y-m-d H:i:s|after_or_equal:' . date('Y-m-d H:i:s'),
            'rentPeriod'   => 'required|int|in:4,8,12,24'
        ];
    }
}
