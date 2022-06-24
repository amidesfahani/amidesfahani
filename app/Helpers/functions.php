<?php

use App\Helpers\DataHelper;

if (!function_exists('dataFirst'))
{
	function dataFirst($data, $key, $_keyname = 'value', $strict = true)
	{
		return DataHelper::First($data, $key, $_keyname, $strict);
	}
}

if (!function_exists('_d'))
{
	function _d($data, $key, $strict = true, $pluck = '', $json = false)
	{
		return DataHelper::dataGet($data, $key, $strict, $pluck, $json);
	}
}

if (!function_exists('__date'))
{
    function __date($date, $format = '', $formats = [])
    {
        if (!$date) return '';

        $lang = app()->getLocale();

        if ($lang == 'fa')
        {
            $date = \Morilog\Jalali\Jalalian::fromCarbon($date);
        }

        if ($format)
        {
            if (count($formats) && array_key_exists($lang, $formats))
            {
                return $date->format($formats[$lang]);
            }

            return $date->format($format);
        }

        return $date;
    }
}

if (!function_exists('___'))
{
    function ___($model, $attribute)
    {
        if (!$model) return '';

        $lang = app()->getLocale();

        if ($lang == 'en') {
            return $model->{$attribute};
        }

        if (isset($model->language))
        {
            if ($model->language == $lang)
            {
                return $model->{$attribute};
            }
        }

        $_attribute = $attribute . '_' . $lang;

        if (isset($model->{$_attribute}) && $model->{$_attribute})
        {
            return $model->{$_attribute};
        }

        if (isset($model->{$_attribute}) && $model->{$_attribute})
        {
            return $model->{$_attribute};
        }

        return $model->{$attribute};
    }
}

function dumpFile($data, $filename = 'dump')
{
    $cloner = new \Symfony\Component\VarDumper\Cloner\VarCloner();
    $dumper = new \Symfony\Component\VarDumper\Dumper\HtmlDumper();
    $output = '';
    $dumper->dump(
        $cloner->cloneVar($data),
        function ($line, $depth) use (&$output) {
            // A negative depth means "end of dump"
            if ($depth >= 0) {
                // Adds a two spaces indentation to the line
                $output .= str_repeat('  ', $depth).$line."\n";
            }
        }
    );
    file_put_contents(public_path() . '/' . $filename . '.html', $output);
}

function dumpLog($data)
{
    file_put_contents(public_path() . '/dump.log', $data.PHP_EOL , FILE_APPEND | LOCK_EX);
}

function dumpSql($query)
{
    $sql_with_bindings = \Str::replaceArray('?', $query->getBindings(), $query->toSql());
    dump($sql_with_bindings);
}
