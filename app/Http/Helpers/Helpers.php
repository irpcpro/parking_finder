<?php

use Illuminate\Support\Facades\App;

if(!function_exists('APIResponse')){
    /**
     * @param mixed ...$data [message, error_code, success]
     * */
    function APIResponse(...$data){
        return app('APIResponse', $data);
    }
}

function getUserIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        // Check for shared clients
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // Check for proxies and load balancers
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        // If neither is available, use the remote address
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    return $ip;
}

function getLatLongFromPoint($value): array {
    preg_match('/POINT\(([\d.]+) ([\d.]+)\)/', $value, $matches);
    return $matches;
}
