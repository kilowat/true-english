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
    private $format;

    public function __construct($en_str = null, $ru_str = null, $format = 'srt')
    {
        $en_str = "1
00:00:13,720 --> 00:00:16,080
When is seeing not believing?

2
00:00:17,120 --> 00:00:20,656
A couple years ago, my friend
sent me this photo from Ürümqi,

3
00:00:20,680 --> 00:00:24,776
which is the capital of Xinjiang
province in northwest China.

4
00:00:24,800 --> 00:00:28,136
On this particular day,
she couldn't believe her eyes.

5
00:00:28,160 --> 00:00:32,400
Checking the quality of the air outside
using this app on her iPad,

6
00:00:33,160 --> 00:00:36,296
the numbers were telling her
the air quality was good,

7
00:00:36,320 --> 00:00:38,160
one on a scale of 500.

8
00:00:38,920 --> 00:00:41,840
But when she looked outside,
she saw something much different.

9
00:00:42,800 --> 00:00:44,896
Yes, those are buildings
in the background.

10
00:00:44,920 --> 00:00:46,240
(Laughter)

11
00:00:47,160 --> 00:00:50,096
But the data were simply
not telling the truth

12
00:00:50,120 --> 00:00:52,536
of what people were seeing and breathing,

13
00:00:52,560 --> 00:00:56,136
and it's because they were
failing to measure PM2.5,

14
00:00:56,160 --> 00:00:58,416
or fine particulate pollution.

15
00:00:58,440 --> 00:01:02,336
When PM2.5 levels
went off the charts in 2012,

16
00:01:02,360 --> 00:01:06,336
or \"crazy bad,\" as the US Embassy
once described it in a tweet,

17
00:01:06,360 --> 00:01:08,536
Chinese denizens took to social media

18
00:01:08,560 --> 00:01:12,216
and they started to question why it was
that they were seeing this disconnect

19
00:01:12,240 --> 00:01:14,256
between official air quality statistics

20
00:01:14,280 --> 00:01:17,000
and what they were seeing
and breathing for themselves.

21
00:01:18,400 --> 00:01:20,536
Now, this questioning has led

22
00:01:20,560 --> 00:01:23,976
to an environmental awakening
of sorts in China,

23
00:01:24,000 --> 00:01:27,560
forcing China's government
to tackle its pollution problems.

24
00:01:28,400 --> 00:01:32,800
Now China has the opportunity
to become a global environmental leader.";
        $ru_str = "2
00:00:13,720 --> 00:00:16,080
Всегда ли стоит верить собственным глазам?

3
00:00:17,120 --> 00:00:20,656
Пару лет назад моя подруга
прислала мне это фото из Урумчи,

4
00:00:20,680 --> 00:00:24,776
столицы Синцзян-Уйгурской автономии
на северо-западе Китая.

5
00:00:24,800 --> 00:00:28,136
В тот день она не могла
поверить своим глазам.

6
00:00:28,160 --> 00:00:32,400
Она тут же проверила качество воздуха, 
используя приложение для iPad.

7
00:00:33,160 --> 00:00:36,296
Цифры показали,
что загрязнение воздуха минимально:

8
00:00:36,320 --> 00:00:38,160
оценка 1 из 500.

9
00:00:38,920 --> 00:00:41,840
Но снаружи всё выглядело совершенно иначе.

10
00:00:42,800 --> 00:00:44,896
Да, это здания на заднем фоне.

11
00:00:44,920 --> 00:00:46,240
(Смех)

12
00:00:47,160 --> 00:00:50,096
Данные просто не отражали того,

13
00:00:50,120 --> 00:00:52,536
что люди видели и чем дышали,

14
00:00:52,560 --> 00:00:56,130
из-за отсутствия изменений уровня
загрязнённости частицами класса PM2.5,

15
00:00:56,160 --> 00:00:58,416
или ультрадисперсными частицами.

16
00:00:58,440 --> 00:01:02,336
Когда в 2012 году с графиков
пропал уровень РМ2.5,

17
00:01:02,360 --> 00:01:06,336
или «безумно плохой», как посольство США
однажды характеризовало его в Твиттере,

18
00:01:06,360 --> 00:01:08,536
жители Китая подняли шум
в социальных сетях

19
00:01:08,560 --> 00:01:12,216
и начали спрашивать,
в чём причина такой разницы

20
00:01:12,240 --> 00:01:14,536
между официальной
статистикой загрязнения воздуха

21
00:01:14,536 --> 00:01:17,000
и тем, что они видели и чем дышали.

22
00:01:18,400 --> 00:01:20,536
В итоге эти вопросы

23
00:01:20,560 --> 00:01:23,976
пробудили интерес китайцев
к состоянию окружающей среды,

24
00:01:24,000 --> 00:01:27,560
заставив правительство Китая
взяться за решение проблем загрязнения.";

        $this->enStr = $en_str;
        $this->ruStr = $ru_str;
        $this->format = $format;
    }


    public function merge(){
        $result = [];

        $en_arr = Subtitles::load($this->enStr, $this->format)->getInternalFormat();
        $ru_arr = Subtitles::load($this->ruStr, $this->format)->getInternalFormat();

        foreach($en_arr as $en_key => $en_value){
            $en_line = implode(" ",$en_value["lines"]);
            $ru_line = "";

            if(array_key_exists($en_key, $ru_arr)){
                $ru_line = implode(" ",$ru_arr[$en_key]["lines"]);
            }

            $result[$en_key] = [
                "start" => $en_value["start"],
                "end" => $en_value["end"],
                "line" => [
                    "en" => $en_line,
                    "ru" => $ru_line,
                ]
            ];
        }

        return $result;
    }
}