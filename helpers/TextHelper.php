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
        $str = preg_replace('/[^0-9а-я\_-]/', '', $str);
        D($str);
        // Trim any leading or trailing separators.
        $str = preg_replace("/^$seppattern+|$seppattern+$/", '', $str);
        // Replace multiple separators with a single one.
        $str = preg_replace("/$seppattern+/", $separator, $str);
        
        return $str;
    }
    
    public static function transliteration($str) {
        $transliteration = array(
            'а' => 'a',
            'б' => 'b',
            'в' => 'v',
            'г' => 'g',
            'д' => 'd',
            'е' => 'e',
            'ё' => 'yo',
            'ж' => 'zh',
            'з' => 'z',
            'и' => 'i',
            'й' => 'j',
            'к' => 'k',
            'л' => 'l',
            'м' => 'm',
            'н' => 'n',
            'о' => 'o',
            'п' => 'p',
            'р' => 'r',
            'с' => 's',
            'т' => 't',
            'у' => 'u',
            'ф' => 'f',
            'х' => 'h',
            'ц' => 'cz',
            'ч' => 'ch',
            'ш' => 'sh',
            'щ' => 'shh',
            'ъ' => 'ʺ',
            'ы' => 'y`',
            'ь' => '',
            'э' => 'e`',
            'ю' => 'yu',
            'я' => 'ya',
            'Ӏ' => '‡',
            '’' => '`', 'ˮ' => '¨',
        );
        
        $str = strtr(mb_strtolower(str_replace(' ', '-', $str), 'UTF-8'), $transliteration);
        $str = preg_replace('|([-]+)|s', '-', $str);
        $str = preg_replace('/[^0-9a-z\-]/', '', $str);
        $str = trim($str, '-');

        return $str;
    }

}
