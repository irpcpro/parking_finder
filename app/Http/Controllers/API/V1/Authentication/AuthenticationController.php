<?php

namespace App\Http\Controllers\API\V1\Authentication;

use App\Events\AuthenticationCodeEvent;
use App\Http\Requests\Authentication\ConfirmationCodeRequest;
use App\Http\Requests\Authentication\SendCodeRequest;
use App\Models\Device;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class AuthenticationController
{

    public function send_code(SendCodeRequest $request)
    {
        // create user
        $user = User::where('mobile', $request->validated()['mobile']);
        if(!$user->exists())
            $user = User::create([
                'mobile' => $request->validated()['mobile'],
            ]);
        else
            $user = $user->first();

        // send code
        event(new AuthenticationCodeEvent($user));

        // response
        $response = APIResponse('کاربر ایجاد و کد تایید شد', 200, true);
        $response = $response->setData($request->validated());
        $response->send();
    }


    public function confirmation_code(ConfirmationCodeRequest $request)
    {
        // get inputs
        $mobile = $request->validated()['mobile'];
        $code = $request->validated()['code'];

        // get user
        $user = User::where('mobile', $mobile);
        if(!$user->exists())
            APIResponse('کاربری با این شماره یافت نشد', 422)->send();

        // get user
        $user = $user->first();

        // check if user have code
        $auth_code = $user->authenticationCodes();
        $auth_code = $auth_code->where('created_at', '>', now()->subSecond(AUTH_CODE_EXPIRE_TIME));
        $auth_code = $auth_code->notExpired();

        // check if user have and code
        if(!$auth_code->exists())
            APIResponse('کد منقضی شده است', 422)->send();

        // get code
        $auth_code = $auth_code->first();

        // check code
        if($auth_code->code != $code)
            APIResponse('کد اشتباه است', 401)->send();

        try{
            // expire code
            $auth_code->update([
                'expired' => true
            ]);

            // update user active status
            if(!$user->active)
                $user->update([
                    'active' => true
                ]);

            // generate token and sent
            $data = [
                'token' => auth('api')->login($user) ?? null
            ];

            // insert log
            $user->LoginLogs()->create([
                'user_ip' => getUserIP(),
                'login_timestamp' => time(),
            ]);

            // insert user device info
            Device::create([
                'user_id' => $user->id,
                'device_info' => $request->validated('device_info'),
                'encode' => DEVICE_INFO_ENCODE
            ]);

            $response = APIResponse('ورود موفقیت آمیز بود', 200, true);
            $response = $response->setData($data);
            $get_response = $response->get();
        }catch (\Exception $exception){
            Log::error('something went wrong in confirm code', [$exception]);
            $get_response = APIResponse('something went wrong in server.',500, false);
            $get_response = $get_response->get();
        }

        $get_response->send();
    }

}
