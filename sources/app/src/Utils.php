<?php


namespace Mono;

/*
 * This Class contains different utility functions exposed staticly
 */
class Utils
{
    /*
     * Function searches a string for first occurence on needle($search)
     * Then returns everything before needle
     */
    public static function before($search, $inthat)
    {
        return substr($inthat, 0, strpos($inthat, $search));
    }

    /*
     * Function searches a string for first occurence on needle($search)
     * Then returns everything after needle
     */
    public static function after ($search, $inthat)
    {
        if (!is_bool(strpos($inthat, $search)))
            return substr($inthat, strpos($inthat,$search)+strlen($search));
    }
}