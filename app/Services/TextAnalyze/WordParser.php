<?php
/**
 * Created by PhpStorm.
 * User: kilowat
 * Date: 15.09.2019
 * Time: 20:24
 */

namespace App\Services\TextAnalyze;


use TextAnalysis\Filters\LambdaFilter;

class WordParser
{
    private static $minWordLength = 3;

    private static $filters = [
        'NumbersFilter',
        'CharFilter',
        'PunctuationFilter',
        'QuotesFilter',
        'SpacePunctuationFilter',
        'TrimFilter',
        'LowerCaseFilter',
        'StripTagsFilter',
        'UrlFilter',
    ];

    public static function getFrequency($text)
    {
        $token = tokenize($text);

        foreach(self::$filters as $filter){
            filter_tokens($token, $filter);
        }

        $stop_words = [];

        filter_stopwords($token, $stop_words);

        $filter = new LambdaFilter(function($word){
            if(strlen($word) < self::$minWordLength)
                return '';
            else
                return $word;

        });

        foreach($token as &$itemToken)
        {
            $itemToken = $filter->transform($itemToken);
        }

        $token = filter_empty($token);

        $freqDist = freq_dist($token);

        return $freqDist;
    }
}