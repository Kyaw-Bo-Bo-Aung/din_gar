<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransferConfirmRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'to_phone' => 'required',
            'transfer_amount' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'to_phone.required' => 'Phone number is required',
            'transfer_amount.required' => 'Transfer amount is required',
            'transfer_amount.integer' => 'Transfer amount must be integer'
        ];
    }
}
