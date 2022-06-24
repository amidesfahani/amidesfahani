<?php

namespace App\Helpers;

class HumanReadable
{
    public static function FileSize($bytes, $translate = false, $round = 0)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];
        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }
        return round($bytes, $round) . ' ' . ($translate ? __($units[$i]) : $units[$i]);
    }
}