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
}