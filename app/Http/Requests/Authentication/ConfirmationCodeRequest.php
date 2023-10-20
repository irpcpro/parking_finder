<?php

namespace App\Http\Requests\Authentication;

use App\Http\Requests\AppRequest;


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
            'code' => ['required', 'string', 'max:' . AUTH_CODE_LENGTH],
            "device_info" => ['nullable', 'string']
        ];
    }

    public function messages()
    {
        return [
            'mobile.required' => 'شماره همراه الزامی است',
            'mobile.regex' => 'فرمت شماره همراه اشتباه است',
            'mobile.exists' => 'شماره همراه وجود ندارد',
            'code.required' => 'کد الزامی است',
            'code.max' => 'طول کد تایید باید '.AUTH_CODE_LENGTH.' کاراکتر باشد',
            'device_info.string' => 'اطلاعات دیوایس باید استرینگ باشد'
        ];
    }

}
