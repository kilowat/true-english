<?php

namespace App\Imports;

use App\Models\Word;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

use Throwable;

class WordImport implements ToModel, WithBatchInserts, SkipsOnError
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if(!key_exists(2, $row)) $row[2] = '';
        if(!key_exists(3, $row)) $row[3] = '';

        return new Word([
            'name' => $row[1],
            'transcription' => $row[2],
            'translate' => $row[3],
        ]);
    }

    public function batchSize(): int
    {
        return 1000;
    }

    /**
     * @param Throwable $e
     */
    public function onError(Throwable $e)
    {
        // TODO: Implement onError() method.
    }
}
