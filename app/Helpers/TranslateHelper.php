<?php

namespace App\Helpers;

use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslateHelper
{
    public static function translate($text = '', $targetLang)
    {
        if (is_null($text)) {
            $text = ''; // Atau berikan nilai default lain
        }
        $tr = new GoogleTranslate(); // Inisialisasi Google Translate tanpa API key
        $tr->setTarget($targetLang); // Set bahasa tujuan
        return $tr->translate($text); // Terjemahkan teks
    }
}
