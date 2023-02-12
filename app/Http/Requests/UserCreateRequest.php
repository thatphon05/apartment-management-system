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
            'email' => 'required|email|unique:users',
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
            'postal_code' => 'required|integer|max_digits:5',
            'id_card_copy' => 'required|file|mimes:pdf',
            'copy_house_registration' => 'required|file|mimes:pdf',
            'rent_contract' => 'required|file|mimes:pdf',
            'room_id' => ['required', new HasRoomRule, new AvailableRoomRule],
            'arrival_date' => 'required|date',
            'deposit' => 'required|numeric',
            'parking_amount' => 'required|numeric|min:0',
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
