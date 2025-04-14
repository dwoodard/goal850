<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    public function rules()
    {
        return [
            'form_name' => [
                'required',
            ],
            'dob' => [
                'required',
                'date_format:Y-m-d',
                'before_or_equal:18 years ago',
                'date',
            ],
            'ssn' => [
                'required',
                'string',
                'size:9',
            ],
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        \Illuminate\Support\Facades\Log::error('Validation failed in RegistrationRequest', [
            'errors' => $validator->errors()->toArray(),
        ]);

        parent::failedValidation($validator);
    }
}
