<?php

namespace App\Http\Requests;

use App\Rules\HasRoomRule;
use App\Rules\UtilityExpenseCycleExistedRule;
use Illuminate\Foundation\Http\FormRequest;

class UtilityExpenseCreateRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'water_unit' => 'required|numeric|min:0',
            'electric_unit' => 'required|numeric|min:0',
            'cycle' => ['date_format:Y-m', new UtilityExpenseCycleExistedRule],
            'room_id' => [new HasRoomRule],
        ];
    }

    public function messages(): array
    {
        return [

        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
