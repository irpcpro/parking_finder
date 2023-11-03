<?php

return [

    // app requests error
    'request' => [
        'error_input' => 'خطا در مقادیر ورودی',
        'error_crash' => 'مشکلی پیش آمده.مجددا تلاش کنید',
        'error_unauthorized' => 'دسترسی محدود میباشد',
    ],

    // authentication
    'auth' => [
        'code' => [
            'created' => 'کاربر ایجاد و کد ارسال شد',
            'wrong' => 'کد اشتباه است',
            'expired' => 'کد منقضی شده است',
        ],
        'user' => [
            'notfound' => 'کاربری با این شماره یافت نشد',
        ],
        'login' => [
            'success' => 'ورود موفقیت آمیز بود',
        ],
        'rule' => [
            'mobile' => [
                'required' => 'شماره همراه الزامی است',
                'regex' => 'فرمت شماره همراه اشتباه است',
                'exists' => 'شماره همراه وجود ندارد',
            ],
            'code' => [
                'required' => 'کد الزامی است',
                'max' => 'طول کد تایید باید '.LENGTH_AUTH_CODE.' کاراکتر باشد',
            ],
            'device_info' => [
                'string' => 'اطلاعات دیوایس باید استرینگ باشد',
            ],
        ]
    ],

    // locations
    'location' => [
        'store' => [
            'success' => 'لوکیشن ثبت شد'
        ],
        'rule' => [
            'lat' => [
                'required' => 'عرض جغرافیایی اجباری می باشد',
                'regex' => 'فرمت عرض جغرافیایی اشتباه است',
            ],
            'long' => [
                'required' => 'طول جغرافیایی اجباری می باشد',
                'regex' => 'فرمت طول جغرافیایی اشتباه است',
            ],
            'title' => [
                'required' => 'عنوان الزامی است',
                'string' => 'عنوان باید از جنس رشته باشد',
                'max' => 'طول عنوان نباید بیشتر از '.LENGTH_LOCATION_INFO_TITLE.' کاراکتر باشد'
            ],
            'description' => [
                'string' => 'توضیحات باید از جنس رشته باشد',
                'max' => 'طول توضیحات نباید بیشتر از '.LENGTH_LOCATION_INFO_DESCRIPTION.' کاراکتر باشد'
            ],
        ],
    ],


];
