<?php

namespace App\Http\Controllers\API\System;

use App\Http\Controllers\Controller;
use App\Models\AuthenticationCode;
use App\Models\User;

class AuthenticationCodeController extends Controller
{
    public function __construct(
        public User $user
    )
    {
        //
    }

    private function generateCode(): string
    {
        $code = '';
        for($i = 0; $i < LENGTH_AUTH_CODE; $i++)
            $code .= AUTH_CODE_FAKE ? "1" : rand(0, 9);
        return $code;
    }

    public function getCode(): bool|string
    {
        // generate code
        $code = $this->generateCode();

        // store in authentication code table
        $status = AuthenticationCode::create([
            'user_id' => $this->user->id,
            'code' => $code,
        ]);

        return (isset($status->id) && $status->id > 0) ? $code : false;
    }
}
