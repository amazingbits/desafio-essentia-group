<?php

namespace Src\Helpers;

class FormatHelper
{
    public static function phoneFormat(string $phoneNumber): string
    {
        $phone = preg_replace('/[^0-9]/i', "", $phoneNumber);
        if (mb_strlen($phone) === 11) {
            return "(" . mb_substr($phone, 0, 2) . ")" . " " . mb_substr($phone, 2, 1) . " " . mb_substr($phone, 3, 4) . "-" . mb_substr($phone, 7, 4);
        } else if (mb_strlen($phone) === 10) {
            return "(" . mb_substr($phone, 0, 2) . ") " . mb_substr($phone, 2, 4) . "-" . mb_substr($phone, 6, 4);
        } else if (mb_strlen($phone) === 9) {
            return mb_substr($phone, 0, 1) . " " . mb_substr($phone, 1, 4) . "-" . mb_substr($phone, 5, 4);
        } else if (mb_strlen($phone) === 8) {
            return mb_substr($phone, 0, 4) . "-" . mb_substr($phone, 4, 4);
        } else {
            return $phone;
        }
    }
}