<?php

namespace App\Imports;

use App\Models\Word;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Row;
use Throwable;

class WordImport implements OnEachRow, SkipsOnError
{
    /*
    public function model(array $row)
    {
        if(!key_exists(2, $row)) $row[2] = '';
        if(!key_exists(3, $row)) $row[3] = '';

        return new WordResource([
            'name' => $row[1],
            'transcription' => $row[2],
            'translate' => $row[3],
        ]);
    }
    */



    /**
     * @param Throwable $e
     */
    public function onError(Throwable $e)
    {
        // TODO: Implement onError() method.
    }


    public function onRow(Row $row)
    {
        $row = $row->toArray();

        if (!isset($row[1])) {
            return null;
        }

        if(!key_exists(2, $row)) $row[2] = '';
        if(!key_exists(3, $row)) $row[3] = '';

        $fields = [
            'name' => $row[1],
            'transcription' => $row[2],
            'translate' => $row[3],
        ];
        if($wordModel = Word::where("name", "=", $row[1])->count()){
            //$wordModel->update($fields);
        }else{
            Word::create($fields);
        }
    }

}
