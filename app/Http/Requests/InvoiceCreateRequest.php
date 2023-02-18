<?php

namespace App\Http\Requests;

use App\Rules\HasRoomRule;
use App\Rules\InvoiceExistedRule;
use App\Rules\UtilityExpenseCycleNotExistedRule;
use Illuminate\Foundation\Http\FormRequest;

class InvoiceCreateRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'cycle' => ['date_format:Y-m', new UtilityExpenseCycleNotExistedRule, new InvoiceExistedRule],
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
