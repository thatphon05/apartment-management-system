<?php

namespace App\Http\Requests;

use App\Rules\HasConfigurationRule;
use Illuminate\Foundation\Http\FormRequest;

class RoomEditRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'configuration_id' => ['required', 'integer', new HasConfigurationRule],
        ];
    }

    public function messages(): array
    {
        return [
            //
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
