<?php

namespace app\helpers;

/**
 * Class TextHelper
 *
 * @author Stableflow
 */
class TextHelper {

    public static function translit($str, $separator = '-') {
        // Escape the separator.
        $seppattern = preg_quote($separator, '/');
        $str = strtolower(str_replace(' ', $separator, $str));
        $str = preg_replace('/[^0-9a-z\_-]/', '', $str);
        // Trim any leading or trailing separators.
        $str = preg_replace("/^$seppattern+|$seppattern+$/", '', $str);
        // Replace multiple separators with a single one.
        $str = preg_replace("/$seppattern+/", $separator, $str);
        return $str;
    }

}
