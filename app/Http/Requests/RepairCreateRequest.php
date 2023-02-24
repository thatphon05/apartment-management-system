<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RepairCreateRequest extends FormRequest
{

    public function rules(): array
    {
        return [

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
