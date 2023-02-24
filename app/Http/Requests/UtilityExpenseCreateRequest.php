<?php

namespace App\Http\Requests;

use App\Rules\ElectricUnitMoreThanLatestRule;
use App\Rules\HasRoomRule;
use App\Rules\UtilityExpenseCycleExistedRule;
use App\Rules\WaterUnitMoreThanLatestRule;
use Illuminate\Foundation\Http\FormRequest;

class UtilityExpenseCreateRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'water_unit' => ['required', 'numeric', 'min:0', new WaterUnitMoreThanLatestRule],
            'electric_unit' => ['required', 'numeric', 'min:0', new ElectricUnitMoreThanLatestRule],
            'cycle' => ['date_format:Y-m', new UtilityExpenseCycleExistedRule],
            'room_id' => [new HasRoomRule],
        ];
    }

    public function attributes(): array
    {
        return [
            'water_unit' => 'มิเตอร์น้ำ',
            'electric_unit' => 'มิเตอร์ไฟ',
            'cycle' => 'ประจำเดือน',
            'room_id' => 'ห้อง',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
