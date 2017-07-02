<?php
/**
 * Sastrawi (https://github.com/sastrawi/sastrawi)
 *
 * @link      http://github.com/sastrawi/sastrawi for the canonical source repository
 * @license   https://github.com/sastrawi/sastrawi/blob/master/LICENSE The MIT License (MIT)
 */

namespace Sastrawi\Stemmer\Filter;

/**
 * Class for normalize text before the stemming process
 */
class TextNormalizer
{
    /**
     * Removes symbols & characters other than alphabetics
     *
     * @param  string $text
     * @return string normalized text
     */
    public static function normalizeText($text)
    {
        $text = strtolower($text);
        $text = preg_replace("/^RT +@[^ :]+:? */i", "", $text);//penghapusan retweet
        $text = preg_replace('/#([\w-]+)/i', '', $text);//penghapusan tag
        $text = preg_replace('/@([\w-]+)/i', '', $text);//penghapusan mention
        $text = preg_replace('/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/', '', $text);//penghapusan url
        $text = preg_replace('/[^a-z -]/im', ' ', $text);
        $text = preg_replace('/( +)/im', ' ', $text);

        return trim($text);
    }
}
