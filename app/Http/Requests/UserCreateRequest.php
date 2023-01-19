<?php

namespace App\Http\Requests;

use App\Rules\AvailableRoomRule;
use App\Rules\HasRoomRule;
use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'telephone' => 'required|numeric',
            'password' => 'required',
            'id_card' => 'required|integer|digits:13',
            'birthdate' => 'required|date',
            'religion' => 'required',
            'name' => 'required',
            'surname' => 'required',
            'address' => 'required',
            'sub_district' => 'required',
            'district' => 'required',
            'province' => 'required',
            'postal_code' => 'required|integer',
            'id_card_copy' => 'required|file|mimes:pdf',
            'copy_house_registration' => 'required|file|mimes:pdf',
            'rent_contract' => 'required|mimes:pdf',
            'room_id' => ['required', new HasRoomRule(), new AvailableRoomRule],
            // 'contract_start' => now(),
            // 'contract_end' => now(),
            // 'deposit' => 'required|numeric',
            'parking_amount' => 'required|numeric',
        ];
    }

    /**
     * @return string[]
     */
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
