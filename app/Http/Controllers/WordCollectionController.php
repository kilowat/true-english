<?php

namespace App\Http\Controllers;

use App\Http\Requests\WordTableDataRequest;
use App\Http\Resources\WordResource;
use App\Models\Audio;
use App\Models\Page;
use App\Models\Word;
use App\Models\WordCard;
use App\Models\WordSection;
use App\Providers\ExcelTableDownloaded;
use App\Providers\ExcelTableWordDownloaded;
use App\Providers\WordCardEvent;
use App\Providers\WordCardExcelDownloaded;
use App\Services\Subtitles\SubtitleCreator;
use Done\Subtitles\Subtitles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class WordCollectionController extends Controller
{
    private $elementPaginateCount = 20;
    private $wordPaginateCount = 10;

    public function __construct()
    {
        \Menu::make('CollectionMenu', function($menu){
            $section = WordSection::withDepth()
                ->having('depth', '=', 0)
                ->where('active', '=', 1)
                ->get();
            foreach($section as $item){
                $menu->add($item->name, ['route'=>["word-collection.section", $item->code]]);
            }
        });
    }

    public function detail($uri, Word $words)
    {
        $arr_uri = explode("/", $uri);
        $element_code = array_pop($arr_uri);
        $section_code = array_pop($arr_uri);

        $card = WordCard::where('code', '=', $element_code)
            ->with('words')->withCount('words')
            ->where('active', '=', 1)
            ->first();
        $section = WordSection::where('code', '=', $section_code)
            ->where('active', '=', 1)
            ->first();

        $this->checkNeedShow404($card);

        return view("pages.word_collection_detail", [
            'card' => $card,
            'section' => $section
        ]);
    }

    public function index(Request $request)
    {
        $page = Page::where("code", "=", $request->getRequestUri())->first();
        
        $elements = WordCard::where('active', '=', 1)
            ->orderBy('sort', 'asc')
            ->paginate($this->elementPaginateCount);

        return view('pages.word_collection_index', compact('elements', 'page'));
    }

    public function section($section_code)
    {
        $current_section = WordSection::where("code", "=", $section_code)
            ->where('active', '=', 1)
            ->first();

        $this->checkNeedShow404($current_section);

        $sections = WordSection::where('parent_id', '=', $current_section->id)
            ->where('active', '=', 1)
            ->orderBy('sort', 'asc')
            ->paginate($this->elementPaginateCount);

        $data =  [
            "sections" => $sections,
            "current_section" => $current_section
        ];

        return view('pages.word_collection_section', $data);
    }

    public function elements($parent_code, $section_code )
    {
        $section = WordSection::where("code", "=", $section_code)
            ->where('active', '=', 1)
            ->first();

        $this->checkNeedShow404($section);

        $elements = WordCard::where("section_id" , "=", $section->id)
            ->where('active', '=', 1)
            ->orderBy('sort', 'asc')
            ->paginate($this->elementPaginateCount);

        $data = [
            'parent_section_code' => $parent_code,
            'section' => $section,
            'elements' => $elements,
        ];

        return view('pages.word_collection_elements', $data);
    }

    public function wordTable($card_id, WordTableDataRequest $request)
    {
        $card = WordCard::where('id','=',$card_id)->first();

        $this->checkNeedShow404($card);

        $sort = $request->column ? $request->column : "freq";
        $order = $request->order ? $request->order : "desc";

        $limit = $request->limit ? $request->limit : 50;

        $this->checkNeedShow404($card);

        $query = Word::whereHas('cards', function($query) use($card_id){
            $query->where('card_id', '=', $card_id);
        })->leftJoin('word_card_words', 'words.name', '=', 'word_card_words.word')
            ->with("audio")
            ->orderBy($sort, $order);

        //$words = $query->paginate($limit);

        $words = $query->where('card_id', '=', $card_id)->get();

        return view("pages.word_table", compact('card','words', 'request'));
    }

    public function wordTableData($card_id, WordTableDataRequest $request)
    {
        $card = WordCard::where('id','=',$card_id)->where('active', '=', 1);

        $sort = $request->column ? $request->column : "freq";
        $order = $request->order ? $request->order : "desc";

        $this->checkNeedShow404($card);

        $query = Word::whereHas('cards', function($query) use($card_id){
            $query->where('card_id', '=', $card_id);
        })->leftJoin('word_card_words', 'words.name', '=', 'word_card_words.word')
            ->with("audio")
            ->orderBy($sort, $order);

        $words = $query->where('card_id', '=', $card_id)->paginate($request->per_page);

        return WordResource::collection($words);
    }

    public function tableFileDownload($id, Response $response)
    {
        $card = WordCard::findOrFail($id);

        $this->checkNeedShow404($card->excel);
        $down_load_file = Storage::disk('excel')->path($card->excel_file);

        if(!file_exists($down_load_file))
        {
            abort(404);
        }

        $headers = ['Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
        $newName = $card->name.'.xlsx';

        event (new WordCardExcelDownloaded($card));

        return response()->download($down_load_file, $newName, $headers);
    }
}
