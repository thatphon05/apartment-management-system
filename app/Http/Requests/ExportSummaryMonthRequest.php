<?php

namespace App\Http\Requests;

use App\Rules\InvoiceNotExistedRule;
use Illuminate\Foundation\Http\FormRequest;

class ExportSummaryMonthRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'cycle' => ['date_format:Y-m', new InvoiceNotExistedRule],
        ];
    }

    public function attributes(): array
    {
        return [

        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
