<?php

namespace App\Exports;

use App\Models\Word;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;

class WordExport implements FromQuery
{
    public function __construct(array $where = [])
    {
        foreach ($where as $key => &$value){
            if(empty($value))
                $value = '';
        }

        $this->where = $where;

        return $this;
    }

    public function query()
    {
        return Word::query()->where($this->where);
    }
}
