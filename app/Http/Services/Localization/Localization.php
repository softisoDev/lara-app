<?php


namespace App\Http\Services\Localization;


class Localization
{
    public static function locale() {
        $locale = request()->segment(1, '');

        if($locale && array_key_exists($locale, app('languages'))) {
            return $locale;
        }

        return "";
    }
}
