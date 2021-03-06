<?php

namespace Merix\LaraPanel\Backend\Laravel\Utils;


class Convert
{
    public static function toString($value)
    {
        if(is_string($value))
            return $value;

        if(is_object($value) && method_exists($value, 'toString'))
            return $value->toString();

        if(is_object($value) && method_exists($value, '__toString'))
            return $value->__toString();

        if(settype($value, 'string'))
            return $value;

        return ''; // There must be a string, not null
    }

    public static function toInteger($value)
    {
        if(is_integer($value))
            return $value;

        if(is_object($value) && method_exists($value, 'toInteger'))
            return $value->toInteger();

        if(is_object($value) && method_exists($value, '__toInteger'))
            return $value->__toInteger();

        if(is_object($value) && method_exists($value, 'toInt'))
            return $value->toInt();

        if(is_object($value) && method_exists($value, '__toInt'))
            return $value->__toInt();

        if(settype($value, 'integer'))
            return $value;

        return 0;
    }

    public static function toBool($value)
    {
        if(is_bool($value))
            return $value;

        if(is_object($value) && method_exists($value, 'toBoolean'))
            return $value->toBoolean();

        if(is_object($value) && method_exists($value, '__toBoolean'))
            return $value->__toBoolean();

        if(is_object($value) && method_exists($value, 'toBool'))
            return $value->toBool();

        if(is_object($value) && method_exists($value, '__toBool'))
            return $value->__toBool();

        if(settype($value, 'boolean'))
            return $value;

        return false;
    }

    public static function fileSizeToHumanReadable($value)
    {
        $power = (int) log($value, 1000);
        $value = round($value/pow(1000, $power), 2);

        $letter = '';
        switch($power)
        {
            case 0:
                $letter = '';
                break;
            case 1:
                $letter = 'k';
                break;
            case 2:
                $letter = 'M';
                break;
            case 3:
                $letter = 'G';
                break;
            case 4:
                $letter = 'T';
                break;
            case 5:
                $letter = 'P';
                break;
        }

        return $value . $letter . 'B';
    }


}