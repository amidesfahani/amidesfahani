<?php

namespace App\Helpers;

class FarsiHelper
{
    public static function formatPhone($input)
    {
        return preg_replace('/(\+?[00]?\d{2,3})?0?(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4})/', '$1 ($2) $3-$4', $input);
    }

    public static function validateColor($input)
    {
        return preg_match(
            '/^(#(?:[0-9a-f]{2}){2,4}|#[0-9a-f]{3}|(?:rgba?|hsla?)\((?:\d+%?(?:deg|rad|grad|turn)?(?:,|\s)+){2,3}[\s\/]*[\d\.]+%?\))$/',
            $input,
            $matches
        ) || preg_match('/#([a-f0-9]{3}){1,2}\b/i', $input, $matches);
    }

    public static function isCardNumber($value)
    {
        preg_match('/^([1-9]{1})([0-9]{15})$/', $value, $matches, PREG_OFFSET_CAPTURE, 0);
        return boolval(count($matches));
    }

    public static function isMobile($mobile)
    {
        return preg_match("/^(0)?9\d{9}$/", self::toEnNumber($mobile));
    }

    public static function toEnNumber($input)
    {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $arabic = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١', '٠'];
        $fixedarabic = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];

        $num = range(0, 9);

        $convertedPersianNums = str_replace($persian, $num, $input);
        $englishNumbersOnly = str_replace($fixedarabic, $num, $convertedPersianNums);

        return $englishNumbersOnly;
    }

    public static function RemoveArabian($string)
    {
        $characters = [
            'ك' => 'ک',
            'دِ' => 'د',
            'بِ' => 'ب',
            'زِ' => 'ز',
            'ذِ' => 'ذ',
            'شِ' => 'ش',
            'سِ' => 'س',
            'ى' => 'ی',
            'ي' => 'ی',
            '١' => '۱',
            '٢' => '۲',
            '٣' => '۳',
            '٤' => '۴',
            '٥' => '۵',
            '٦' => '۶',
            '٧' => '۷',
            '٨' => '۸',
            '٩' => '۹',
            '٠' => '۰',
        ];
        return str_replace(array_keys($characters), array_values($characters), $string);
    }

    public static function jdateFromString($string)
    {
        $months = [
            "January" => "ژانویه",
            "February" => "فوریه",
            "March" => "مارچ",
            "April" => "آوریل",
            "May" => "می",
            "June" => "جون",
            "July" => "جولای",
            "August" => "آگوست",
            "September" => "سپتامبر",
            "October" => "اوکتبر",
            "November" => "نوامبر",
            "December" => "دسامبر"
        ];
        $string = str_replace($months, array_keys($months), $string);
        return jdate($string);
    }
}
