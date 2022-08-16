<?php
/**
 * Created by PhpStorm.
 * User: Nikolay
 * Date: 19.03.2018
 * Time: 16:42
 */

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class Transliterate
{
    public static function getLetters()
    {
        $letters      = [];
        $list = Storage::get('transliterate/letters.json');

        if ($list) {
            $letters = json_decode($list, true);
        }

        return $letters;
    }


}