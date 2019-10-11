<?php


namespace Mono;

/*
 * This Class contains different utility functions exposed staticly
 */
class Utils
{
    public static function before($search, $inthat)
    {
        return substr($inthat, 0, strpos($inthat, $search));
    }

    public static function after ($search, $inthat)
    {
        if (!is_bool(strpos($inthat, $search)))
            return substr($inthat, strpos($inthat,$search)+strlen($search));
    }
}