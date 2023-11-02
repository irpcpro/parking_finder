<?php

namespace App\Http\Requests\Authentication;

use App\Http\Requests\AppRequest;
use Illuminate\Support\Facades\Lang;

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
            'mobile.required' => Lang::get('msg.auth.rule.mobile.required'),
            'mobile.regex' => Lang::get('msg.auth.rule.mobile.regex'),
        ];
    }

}
