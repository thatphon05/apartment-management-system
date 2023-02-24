<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'password' => 'required',
            'password_confirmation' => 'required',
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
