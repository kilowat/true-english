<?php
/**
 * Created by PhpStorm.
 * User: kilowat
 * Date: 15.09.2019
 * Time: 20:24
 */

namespace App\Services\TextAnalyze;


class WordParser
{
    private static $filters = [
        'NumbersFilter',
        'CharFilter',
        'PunctuationFilter',
        'QuotesFilter',
        'SpacePunctuationFilter',
        'TrimFilter',
        'LowerCaseFilter',
    ];

    public static function getFrequency($text){
        $token = tokenize($text);

        foreach(self::$filters as $filter){
            filter_tokens($token, $filter);
        }

        $stop_words = ['a', 'an', 'the', 'is', 'are', 'of', 'off', 'to'];

        filter_stopwords($token, $stop_words);

        $token = filter_empty($token);

        $freqDist = freq_dist($token);

        return $freqDist;
    }
}