<?php

namespace App\Console\Commands;

use App\Models\WordCard;
use App\Models\YoutubeParsered;
use App\Services\Subtitles\SubtitleCreator;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class YoutubeSync extends Command
{

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
            ->where("status", "=", 1)
            ->where("en_text", "!=", "")
            ->where('ru_text', "!=", "")
            ->get();

        $item = $youtubeItems[0];
        $fields = $this->makeFields($item);
        $created_card = $this->wordCard->create($fields);

        $this->wordCard->insertWords($item->en_text, $created_card->id, true);
    }

    private function makeFields($item)
    {
        $fields = [];
        $creator = new SubtitleCreator($item->en_text, $item->ru_text, $item->ipa_text);
        $fields['code'] = $title = Str::slug($item->title."-".$item->code, "-");
        $fields["subtitles"] = $creator->merge();
        $fields["name"] = $item->title;
        $fields["content_text"] = $item->en_text;
        $fields["ensubtitle"] = $item->en_text;
        $fields["rusubtitle"] = $item->ru_text;
        $fields["trsubtitle"] = $item->ipa_text;
        $fields["picture"] = "";
        $fields["youtube"] = $item->code;
        $fields["title"] = $item->title;
        $fields["section_id"] = $item->section_id;
        $fields["active"] = 1;
        /*
            $info = pathinfo($url);
            $contents = file_get_contents($url);
            $file = '/tmp/' . $info['basename'];
            file_put_contents($file, $contents);
            $uploaded_file = new UploadedFile($file, $info['basename']);
            */
        return $fields;
    }
}
