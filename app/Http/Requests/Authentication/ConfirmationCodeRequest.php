<?php

namespace App\Http\Requests\Authentication;

use App\Http\Requests\AppRequest;
use Illuminate\Support\Facades\Lang;


class ConfirmationCodeRequest extends AppRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'mobile' => ['required', 'bail', 'exists:users,mobile', 'regex:' . REGEX_MOBILE],
            'code' => ['required', 'string', 'max:' . LENGTH_AUTH_CODE],
            "device_info" => ['nullable', 'string']
        ];
    }

    public function messages()
    {
        return [
            'mobile.required' => Lang::get('msg.auth.rule.mobile.required'),
            'mobile.regex' => Lang::get('msg.auth.rule.mobile.regex'),
            'mobile.exists' => Lang::get('msg.auth.rule.mobile.exists'),
            'code.required' => Lang::get('msg.auth.rule.code.required'),
            'code.max' => Lang::get('msg.auth.rule.code.max'),
            'device_info.string' => Lang::get('msg.auth.rule.device_info.string'),
        ];
    }

}
