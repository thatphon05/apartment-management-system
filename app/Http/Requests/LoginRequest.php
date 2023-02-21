<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required'
        ];
    }

    public function attributes(): array
    {
        return [

        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
