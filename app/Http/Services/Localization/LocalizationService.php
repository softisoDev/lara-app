<?php


namespace App\Http\Services\Localization;

use Illuminate\Support\Facades\Facade;

class LocalizationService extends Facade
{
    protected static function getFacadeAccessor() {
        return "Localization";
    }
}
