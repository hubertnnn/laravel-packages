<?php

namespace Merix\LaraPanel\Backend\Laravel\Utils;


class Utils
{
    public static function getUniqueFileName($baseDirectory, $fileName = '')
    {
        // Make sure the correct directory exists
        \File::makeDirectory($baseDirectory, 493, true, true);


        $time = microtime();
        while(true)
        {
            $name = md5($fileName . $time);

            if(\File::exists($baseDirectory . $name))
            {
                $time++;
                continue;
            }

            return $name;
        }
    }
}