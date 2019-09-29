<?php
/**
 * Created by PhpStorm.
 * User: kilowat
 * Date: 23.09.2019
 * Time: 15:29
 */

namespace App\Services\Subtitles;


use Done\Subtitles\Subtitles;

class SubtitleCreator
{
    private $enStr;
    private $ruStr;
    private $trStr;
    private $format;

    public function __construct($en_str, $ru_str = null, $tr_str = null ,$format = 'srt')
    {
        $this->enStr = $en_str;
        $this->ruStr = $ru_str;
        $this->trStr = $tr_str;
        $this->format = $format;
    }


    public function merge()
    {
        $result = [];

            $en_arr = Subtitles::load($this->enStr, $this->format)->getInternalFormat();

            $ru_arr = [];
            $tr_arr = [];

            if(!empty($this->ruStr)){
                $ru_arr = Subtitles::load($this->ruStr, $this->format)->getInternalFormat();
            }

            if(!empty($this->trStr)){
                $tr_arr = Subtitles::load($this->trStr, $this->format)->getInternalFormat();
            }

            foreach($en_arr as $en_key => $en_value){
                $en_line = implode(" ",$en_value["lines"]);
                $ru_line = "";
                $tr_line = "";

                if(array_key_exists($en_key, $ru_arr)){
                    $ru_line = implode(" ",$ru_arr[$en_key]["lines"]);
                }

                if(array_key_exists($en_key, $tr_arr)){
                    $tr_line = implode(" ",$tr_arr[$en_key]["lines"]);
                }

                $result[$en_key] = [
                    "start" => $en_value["start"],
                    "end" => $en_value["end"],
                    "line" => [
                        "time" => $this->getHoursMinutes($en_value["start"]),
                        "en" => $en_line,
                        "ru" => $ru_line,
                        "tr" => $tr_line,
                    ]
                ];
            }

        return $result;
    }

    private function getHoursMinutes($seconds) {

        if (empty($seconds) || ! is_numeric($seconds) || $seconds <=0) {
            return "00:00:00";
        }

        $H = floor($seconds / 3600);
        $i = ($seconds / 60) % 60;
        $s = $seconds % 60;
        return sprintf("%02d:%02d:%02d", $H, $i, $s);
    }
}