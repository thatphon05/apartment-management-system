<?php

namespace App\Http\Requests;

use App\Enums\PaymentStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class PaymentEditRequest extends FormRequest
{
    /**
     * @return string[]
     **/
    public function rules(): array
    {
        return [
            'status' => [new Enum(PaymentStatusEnum::class)]
        ];
    }

    /*
    * @return string[]
    **/
    public function messages(): array
    {
        return [

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
