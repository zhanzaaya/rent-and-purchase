<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email'    => ['required', 'email', 'unique:users'],
            'password' => ['required', 'string'],
            'name'     => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [

        ];
    }
}
