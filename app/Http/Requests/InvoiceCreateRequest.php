<?php

namespace App\Http\Requests;

use App\Rules\HasBooking;
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
            'room_id' => [new HasRoomRule, new HasBooking],
        ];
    }

    public function attributes(): array
    {
        return [
            'cycle' => 'ใบแจ้งหนี้ประจำเดือน',
            'room_id' => 'เลือกห้องพัก',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
