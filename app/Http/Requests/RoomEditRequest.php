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

    public function attributes(): array
    {
        return [
            'configuration_id' => 'ตั้งค่าการบริการ',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
