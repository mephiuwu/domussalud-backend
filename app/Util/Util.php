<?php

namespace App\Util;

class Util
{
    public static function formatChileanPhone($phone){
        $phone = preg_replace('/\D/', '', $phone);

        $length = strlen($phone);
        if ($length < 8) {
            return 'Número no válido';
        } elseif ($length == 8) {
            return '+569' . $phone;
        } elseif ($length == 9) {
            return '+56' . $phone;
        } elseif ($length == 11) {
            return '+' . $phone;
        } else {
            return 'Número no válido';
        }
    }
}
