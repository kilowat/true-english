<?php

namespace App\Exports;

use App\Models\Word;

use Illuminate\Database\Query\Builder;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;

class WordExport implements FromQuery, WithMapping
{
    private $where;
    private $needWhereEmptyAudio = false;

    public function __construct(array $where = [])
    {
        foreach ($where as $key => &$value){
            if(empty($value))
                $value = '';

            if($key == 'audio'){
                $this->needWhereEmptyAudio = true;
                unset($where[$key]);
            }
        }

        $this->where = $where;
    }

    public function query()
    {
        $word_query = Word::query()->where($this->where);

        if($this->needWhereEmptyAudio){
            $word_query->whereDoesntHave('audio', function($query){

            });
        }

        return $word_query;
    }

    public function map($word): array
    {
        return [
            $word->id,
            $word->name,
            $word->transcription,
            $word->translate,
        ];
    }
}
