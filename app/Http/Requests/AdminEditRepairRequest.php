<?php

namespace App\Http\Requests;

use App\Enums\RepairStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class AdminEditRepairRequest extends FormRequest
{
    /**
     * @return string[]
     **/
    public function rules(): array
    {
        return [
            'status' => [new Enum(RepairStatusEnum::class)],
            'repair_date' => 'date_format:Y-m-d\TH:i|nullable',
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
