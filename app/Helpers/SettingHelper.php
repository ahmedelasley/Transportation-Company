<?php

namespace App\Helpers; // Your helpers namespace 
use App\Models\Setting;

class SettingHelper
{

    public static function setting($key = 'name') {
        return Setting::where('key', $key)->first()->value;
    }


}