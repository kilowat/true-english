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

        foreach ($youtubeItems as $item) {
            $fields = $this->makeFields($item);
            if($updateCard = $this->wordCardModel->where("code", "=", $fields["code"])->first()){
                $updateCard->update($fields);
                $card = $updateCard;
            }else{
                $card = $this->wordCardModel->create($fields);
            }

            if ($item->picture) {
                $pic = $this->getPicture($item);
                $card->uploadImage($pic, 'picture');
            }

            $this->wordCardModel->insertWords($item->en_text, $card->id, true);

            $this->youtubeModel->where("code", "=", $item->code)->update(['status'=>2]);

        }
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
        $fields["youtube"] = $item->code;
        $fields["title"] = $item->title;
        $fields["section_id"] = $item->section_id;
        $fields["active"] = 1;

        return $fields;
    }

    private function getPicture($item)
    {
        $contents = file_get_contents($item->picture);
        $file = "storage\\app\\tmp\\" . $item->code . ".jpg";
        file_put_contents($file, $contents);
        $uploaded_file = new File($file);
        return $uploaded_file;
    }
}
