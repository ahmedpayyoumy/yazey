<?php
namespace App\Helpers;

class TextHelper
{
    public static function containPhoneNumber($str, &$matches = null)
    {
        // $check = preg_match('/(09|01|03|07|08|05[2|6|8|9])+([0-9]{8})\b/', $str, $matches);
        $re = '/[^!\s#$%^&*()+=-[\]\';,.\/{}|:<>?~][0-9 .]{9,}$/';
        $check = preg_match($re, $str, $matches, PREG_OFFSET_CAPTURE, 0);
        return $check;
    }
    //Escape white space, dot, ...
    public static function formatPhoneNumber($str) {
        $str = preg_replace('/[A-Za-z]/i', '', $str);
        $str = str_replace(
                array( '\'', '"', ',' , ';', '<', '>', ':', '!', '@', '#', '$', '%', '^', '&', '*', '(', ')',
                        '-', '_', '+', '=', '.', '/', '\\', '|', '<', '>', '?'), '', $str);
        return $str;
    }
}
