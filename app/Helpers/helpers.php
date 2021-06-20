<?php
use App\Models\SetupSite;

if (!function_exists('setting')) {
    function setting()
    {
        return $get_settings = SetupSite::first();
    }
}
