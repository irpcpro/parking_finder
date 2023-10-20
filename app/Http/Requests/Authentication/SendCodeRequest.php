<?php

namespace App\Http\Requests\Authentication;

use App\Http\Requests\AppRequest;

class SendCodeRequest extends AppRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'mobile' => ['required', 'bail', 'regex:' . REGEX_MOBILE],
            'name' => ['string']
        ];
    }

    public function messages()
    {
        return [
            'mobile.required' => 'شماره همراه الزامی است',
            'mobile.regex' => 'فرمت شماره همراه اشتباه است',
        ];
    }

}
