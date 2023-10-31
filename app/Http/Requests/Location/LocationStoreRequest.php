<?php

namespace App\Http\Requests\Location;

use Illuminate\Foundation\Http\FormRequest;

class LocationStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'lat' => ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'long' => ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/']
        ];
    }

    public function messages()
    {
        return [
            'lat' => 'عرض جغرافیایی اجباری می باشد',
            'long' => 'طول جغرافیایی اجباری می باشد',
        ];
    }

}
