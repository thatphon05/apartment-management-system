<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'password_old' => 'required',
            'password_new' => 'required',
            'password_new_confirmation' => 'required',
        ];
    }

    public function attributes(): array
    {
        return [
            'password_old' => 'รหัสผ่านเก่า',
            'password_new' => 'รหัสผ่านใหม่',
            'password_new_confirmation' => 'ยืนยันรหัสผ่านใหม่',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
