<?php

namespace App\Console\Commands;

use App\Models\WordCard;
use App\Models\YoutubeParsered;
use App\Services\Subtitles\SubtitleCreator;
use Illuminate\Console\Command;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\FileBag;

class YoutubeSync extends Command
{
    const STATUS_ERROR = 3;
    const STATUS_SYNCED = 2;
    const STATUS_PARSED = 1;

    private $youtubeModel;
    private $wordCardModel;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'youtube:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Read rows in youtube table and add as new card';

    /**
     * Create a new command instance.
     *
     * @param YoutubeParsered $youtubeModel
     * @param WordCard $wordCardModel
     */
    public function __construct(YoutubeParsered $youtubeModel, WordCard $wordCardModel)
    {
        $this->youtubeModel = $youtubeModel;
        $this->wordCardModel = $wordCardModel;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->exec();
    }

    private function exec()
    {
        $youtubeItems = $this->youtubeModel
            ->where("status", "=", self::STATUS_PARSED)
            ->where("en_text", "!=", "")
            ->where('ru_text', "!=", "")
            ->get();

        foreach ($youtubeItems as $item) {
            echo "read: ".$item->id. "\n";

            $fields = $this->makeFields($item);

            if(empty($fields["subtitles"])) continue;

            if($updateCard = $this->wordCardModel->where("youtube", "=", $fields["youtube"])->first()){
                continue;
                //$updateCard->update($fields);
                //$card = $updateCard;
            }else{
                try {
                    $card = $this->wordCardModel->create($fields);
                }catch(\Exception $e){
                    echo "Create card error: ".$e->getMessage() . " element_id:".$item->id."\n";
                    continue;
                }
            }

            if ($item->picture) {
                $pic = $this->getPicture($item);
                $card->uploadImage($pic, 'picture');
            }

            $this->wordCardModel->insertWords($item->en_text, $card->id, true);
            //!!!!!!!!!!!!
            $this->youtubeModel->where("code", "=", $item->code)->update(['status'=>self::STATUS_SYNCED]);
        }
    }

    private function makeFields(YoutubeParsered $item)
    {
        $fields = [];
        $fields['code'] = $title = Str::slug(Str::limit($item->title, 30, '')."-".$item->code, "-");
        $fields["subtitles"] = "";

        try {
            $subtitles = $this->prepareSubtitles($item);

            //$creator = new SubtitleCreator($item->en_text, $item->ru_text, $item->ipa_text);
            $creator = new SubtitleCreator($subtitles["en_text"], $subtitles['ru_text'], $subtitles["ipa_text"]);
            $fields["subtitles"] = $creator->merge();
        }catch (\Exception $e){
            echo "SubtitlesCreator error: ".$e->getMessage() . " element_id:".$item->id."\n";
            $this->youtubeModel->where("id", "=", $item->id)->update(['status'=>self::STATUS_ERROR]);
        }

        $fields["name"] = $item->title;
        $fields["content_text"] = $item->en_text;
        $fields["ensubtitle"] = $item->en_text;
        $fields["rusubtitle"] = $item->ru_text;
        $fields["trsubtitle"] = $item->ipa_text;
        $fields["youtube"] = $item->code;
        $fields["title"] = $item->title;
        $fields["section_id"] = $item->section_id;
        $fields['active'] = "on";
        return $fields;
    }

    private function getPicture(YoutubeParsered $item)
    {
        $contents = file_get_contents($item->picture);
        $file = "storage".DIRECTORY_SEPARATOR."app".DIRECTORY_SEPARATOR."tmp". DIRECTORY_SEPARATOR . $item->code . ".jpg";
        file_put_contents($file, $contents);
        $uploaded_file = new File($file);
        return $uploaded_file;
    }

    private function prepareSubtitles(YoutubeParsered $item)
    {
        $en = $this->clearSubtitles($item->en_text);
        $ru = $this->clearSubtitles($item->ru_text);
        $ipa = $this->clearSubtitles($item->ipa_text);

        $result = [
            "en_text" => $en['text'],
            "ru_text" => $ru['text'],
            "ipa_text" => $ipa['text'],
        ];

        if($en['count'] != $ru['count'])
        {
            $field = [
                "en_after_check" => $result['en_text'],
                "ru_after_check" => $result['ru_text'],
            ];
            $this->youtubeModel->where("code", "=", $item->code)->update($field);

            throw new \Exception('diff length');
        }

        return $result;
    }

    private function clearSubtitles($text)
    {
        $text_lines = explode("\n\n", $text);
        $new_lines = [];
        $count = 1;
        foreach($text_lines as $key => $line){
            $sub_line = explode("\n", $line);
            //clear wrong \n
            if(empty($sub_line[0]))
                array_shift($sub_line);


            $sub_line[0] = $count;
            ////////////////////
            $new_line = implode("\n", $sub_line);
            //Перевел, перевела, переводчик

            if($key == 0 && preg_match('/ерев/', $new_line)){
                continue;
            }

            $new_lines[] = $new_line;
            $count++;
            /*
            if (!preg_match('/[♪(]/', $new_line)
                && !preg_match('/playing]/', $new_line)
                && !preg_match('/music]/', $new_line)
                && !preg_match('/играет]/', $new_line)
                && !preg_match('/музыка]/', $new_line)) {

                $new_lines[] = $new_line;
                $count++;
            }
            */

        }

        $result = [
            "text" =>implode("\n\n", $new_lines),
            "count" => $count
        ] ;
        return $result;
    }
}
