<?php

namespace App\Http\Requests;

use App\Enums\RepairStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class AdminEditRepairRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'status' => [new Enum(RepairStatusEnum::class)],
            'repair_date' => 'date_format:Y-m-d\TH:i|nullable',
        ];
    }

    public function attributes(): array
    {
        return [
            'status' => 'สถานะ',
            'repair_date' => 'วันที่เข้าซ่อม',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
