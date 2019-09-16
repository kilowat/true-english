<?php

namespace App\Exports;

use App\Models\Word;

use Maatwebsite\Excel\Concerns\FromCollection;

class WordExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Word::all();
    }
}
