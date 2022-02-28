<?php

namespace App\Utils;

class Misc
{
    public static function validatePhoneNumber(string $number): bool {
        if($number[0] !== "+") {
            return false;
        }
        $numberContent = substr($number, 1);
        if(preg_match("/^\d+$/", $numberContent)) {
            return true;
        }
        return false;
    }
}
