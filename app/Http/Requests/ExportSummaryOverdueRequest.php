<?php

namespace App\Http\Requests;

use App\Rules\InvoiceLastDateNotExistedRule;
use Illuminate\Foundation\Http\FormRequest;

class ExportSummaryOverdueRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'cycle' => ['date_format:Y-m', new InvoiceLastDateNotExistedRule],
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
