<?php

namespace App\Http\Requests;

use App\Rules\HasConfigurationRule;
use Illuminate\Foundation\Http\FormRequest;

class RoomEditRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'configuration_id' => ['required', 'integer', new HasConfigurationRule()],
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            //
        ];
    }

    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }
}
