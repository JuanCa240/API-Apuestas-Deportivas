<?php

namespace App\Helpers;

use Carbon\Carbon;

class OtpHelper{

    public static function generateOtp(): string{
        return (string) random_int(100000, 999999);
    }

    public static function expirationTime(): Carbon{
        return Carbon::now()->addMinutes(5);
    }

    public static function isExpired($expiration): bool{
        return Carbon::now()->greaterThan($expiration);
    }
}