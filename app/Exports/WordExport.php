<?php

namespace App\Exports;

use App\Models\Word;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;

class WordExport implements FromQuery, WithMapping
{
    private $where;

    public function __construct(array $where = [])
    {
        foreach ($where as $key => &$value){
            if(empty($value))
                $value = '';
        }

        $this->where = $where;
    }

    public function query()
    {
        $word_query = Word::query()->where($this->where);

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
