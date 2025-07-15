<?php

namespace App\Helpers;

use DOMDocument;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Helper
{


    public static function truncateHtml($html, $wordLimit = 20, $end = '...')
    {
        libxml_use_internal_errors(true);

        $dom = new DOMDocument();
        @$dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
        libxml_clear_errors();

        $body = $dom->getElementsByTagName('body')->item(0);
        if (!$body) {
            return '';
        }

        $text = '';
        $wordCount = 0;
        $stop = false;

        $traverseNodes = function ($node) use (&$text, &$wordCount, $wordLimit, &$stop, &$traverseNodes) {
            if ($stop) return;

            if ($node->nodeType == XML_TEXT_NODE) {
                $words = preg_split('/\s+/', trim($node->nodeValue));
                $remainingWords = $wordLimit - $wordCount;

                if ($remainingWords <= 0) {
                    $stop = true;
                    return;
                }

                $text .= implode(' ', array_slice($words, 0, $remainingWords)) . ' ';
                $wordCount += count($words);
                if ($wordCount >= $wordLimit) {
                    $stop = true;
                }
            } else {
                foreach ($node->childNodes as $child) {
                    $traverseNodes($child);
                }
            }
        };

        $traverseNodes($body);

        return '<div>' . trim($text) . $end . '</div>';
    }


    public static function cssFilesPath(string $string)
    {
        return asset('assets/front/css/' . $string);
    }
    public static function getFrontPath(string $string)
    {
        return asset('public/assets/front/' . trim($string, '/'));
    }
    public static function vendorFilesPath(string $string)
    {
        return asset('assets/front/vendor/' . $string);
    }

    public static function webfontsFilesPath(string $string)
    {
        return asset('assets/front/webfonts/' . $string);
    }

    public static function pluginsFilesPath(string $string)
    {
        return asset('assets/plugins/' . $string);
    }

    public static function jsFilesPath(string $string)
    {
        return asset('assets/front/js/' . $string);
    }

    public static function imageFilesPath(string $string)
    {
        return asset('assets/front/img/' . $string);
    }

    public static function uploadedImagesPath($model, $image)
    {
        return asset('uploads/' . $model . '/source/' . $image);
    }

    public static function uploadedSliderImagesPath($model, $image)
    {
        return asset('uploads/sliders/' . $model . '/source/' . $image);
    }
    public static function AppLogo()
    {
        $config = \App\Models\Configration::first();
        return asset('uploads/settings/source/' . ($config->app_logo ?? 'logo.png'));
    }
    public static function FooterLogo()
    {
        $config = \App\Models\Configration::first();
        return asset('uploads/settings/source/' . ($config->footer_logo ?? 'logo.png'));
    }
    public static function FavIcon()
    {
        $config = \App\Models\Configration::first();
        return asset('uploads/settings/source/' . ($config->fav_icon ?? 'logo.png'));
    }
    public static function AboutImage()
    {
        $config = \App\Models\Configration::first();
        return asset('uploads/settings/source/' . ($config->about_image ?? 'logo.png'));
    }
    public static function AppUrl($path = '/')
    {
        return LaravelLocalization::localizeUrl($path);
    }

         public static function removeTags(string | null $text): string
    {
        return html_entity_decode(strip_tags($text));
    }


    public static function cutText(string | null $text, int $length, string $after = ' '): string
    {
        if ($length <= 0 || $length >= mb_strlen($text)) {
            return $text;
        }

        $specialCharPos = mb_strpos($text, $after, $length);

        if ($specialCharPos !== false) {
            return mb_substr($text, 0, $specialCharPos + 1);
        }

        return mb_substr($text, 0, $length);
    }


    public static function removeTagsAndCutText(string | null $text, int $length , string $after = ' '): string
    {
        $cleanText = self::removeTags($text);
        // If $number is specified, cut after the first space or special character
        if ($length > 0) {
            return self::cutText($cleanText, $length, $after);
        }

        return $cleanText;
    }
}
