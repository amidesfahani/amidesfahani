<?php
namespace App\Helpers;

class DataHelper
{
	public static function First($data, $key, $_keyname = 'value', $strict = true)
	{
		$lang = app()->getLocale();

		if ($strict) {
			$data = $data->where('key', $key)->where('language', $lang);
		}
		else
		{
			$data = $data->where('key', $key)->filter(function($d) use ($lang) {
				return $d->langauge == $lang || !$d->language;
			});
		}

		if ($_data = $data->where('key', $key)->first()) return $_data->{$_keyname};
	}

	public static function Get($data, $key, $strict = true)
	{
		if ($data->where('key', $key)->count()) $data->where('key', $key);
	}

	public static function dataGet($data, $key, $strict = true, $pluck = '', $json = false)
	{
		$lang = app()->getLocale();

		if ($data->where('key', $key)->count())
		{
			$data = $data->where('key', $key);
			if ($strict) {
				$data = $data->where('language', $lang);
			}

			if ($data->where('key', $key)->count())
			{
				if ($pluck)
				{
					$data = $data->pluck($pluck);
				}
				if ($json) {
					return json_encode($pluck ? $data : $data->toArray());
				}
				return $data;
			}
		};
	}
}
