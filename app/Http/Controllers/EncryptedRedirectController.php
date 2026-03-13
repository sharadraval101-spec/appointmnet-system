<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class EncryptedRedirectController extends Controller
{
    
    public function handle(string $token)
    {
        try {
            $decoded = urldecode($token);
            $url = Crypt::decryptString($decoded);

            $appUrl = rtrim(config('app.url'), '/');

            if (Str::startsWith($url, ['http://', 'https://'])) {
                if (!Str::startsWith($url, $appUrl . '/')) {
                    abort(403, 'Forbidden redirect host.');
                }
                return redirect()->to($url);
            }

            if (!Str::startsWith($url, '/')) {
                $url = '/' . $url;
            }

            return redirect($url);

        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            abort(400, 'Invalid or expired link.');
        } catch (\Exception $e) {
            abort(400, 'Bad request.');
        }
    }
}
