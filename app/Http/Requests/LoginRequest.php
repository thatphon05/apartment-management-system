<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'กรุณากรอก Email',
            'email.email' => 'รูปแบบ Email ไม่ถูกต้อง',
            'password.required' => 'กรุณากรอกรหัสผ่าน'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
