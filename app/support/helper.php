<?php

use Illuminate\Support\Facades\Crypt;

if (!function_exists('encrypted_route')) {
    /**
     * Generate a URL to a route with encryption
     */
    function encrypted_route($name, $parameters = [], $absolute = true)
    {
        $url = route($name, $parameters, $absolute);
        $token = Crypt::encryptString($url);
        return route('go.encrypted', ['token' => urlencode($token)]);
    }
}
if (!function_exists('decrypt_url')) {
    /**
     * Decrypt a URL token
     */
    function decrypt_url($token)
    {
        try {
            $decoded = urldecode($token);
            return Crypt::decryptString($decoded);
        } catch (\Exception $e) {
            return null; // or handle the exception as needed
        }
    }
}