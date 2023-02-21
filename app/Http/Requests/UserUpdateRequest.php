<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'telephone' => 'required|numeric|max_digits:10',
            'id_card' => 'required|integer|digits:13',
            'birthdate' => 'required|date',
            'religion' => 'required',
            'name' => 'required',
            'surname' => 'required',
            'address' => 'required',
            'sub_district' => 'required',
            'district' => 'required',
            'province' => 'required',
            'postal_code' => 'required|integer|max_digits:5',
            'id_card_copy' => 'file|mimes:pdf',
            'copy_house_registration' => 'file|mimes:pdf',
        ];
    }

    public function attributes(): array
    {
        return [
            'telephone' => 'เบอร์โทรศัพท์',
            'id_card' => 'หมายเลขบัตรประชาชน',
            'birthdate' => 'วันเกิด',
            'religion' => 'ศาสนา',
            'name' => 'ชื่อ',
            'surname' => 'นามสกุล',
            'address' => 'ที่อยู่',
            'sub_district' => 'ตำบล',
            'district' => 'อำเภอ',
            'province' => 'จังหวัด',
            'postal_code' => 'รหัสไปรษณีย์',
            'id_card_copy' => 'ไฟล์สำเนาบัตรประชาชน',
            'copy_house_registration' => 'ไฟล์สำเนาทะเบียนบ้าน',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
