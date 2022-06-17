<?php

namespace App\ACME;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

class Helper extends Controller
{
    public $auth;
    public $separators;
    /**
     * AdminHelper constructor.
     */
    public function __construct()
    {
        parent::__construct();

        if (PHP_OS == 'WINNT') {
            $this->separators = '\\';
        } else {
            $this->separators = '/';
        }

        $this->auth = Auth::user();
    }

    /**
     * @param $str
     * @param bool $needEncryption
     * @return string
     */
    public function encryptURL($str, $needEncryption = false)
    {
        if ($needEncryption) {
            return base64_encode(serialize(encrypt($str . '@' . time())));
        } else {
            return $str;
        }
    }

    /**
     * @param $str
     * @param bool $needDecryption
     * @return mixed
     */
    public function decryptURL($str, $needDecryption = false)
    {
        if ($needDecryption) {
            $decode = base64_decode($str);
            $url = (new IsSerialized())->is_serialized($decode) ? explode('@', decrypt(unserialize($decode)))[0] : $str;
            return $url;
        } else {
            return $str;
        }
    }

    /**
     * @param $value
     * @return mixed
     */
    public static function captchaRules($value)
    {
        $client = new Client();
        $response = $client->post('https://www.google.com/recaptcha/api/siteverify', ['form_params' => ['secret' => env('GOOGLE_CAPTCHA_SECRET'), 'response' => $value]]);
        $body = json_decode((string)$response->getBody());
        return $body->success;
    }
}