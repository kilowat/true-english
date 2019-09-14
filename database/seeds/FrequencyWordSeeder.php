<?php

use Illuminate\Database\Seeder;

class FrequencyWordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrData = [
            [
                'card_id' => 1,
                'word_id' => 1,
                'freq_value' => 99.9,
            ],
            [
                'card_id' => 1,
                'word_id' => 1,
                'freq_value' => 99.9,
            ],
            [
                'card_id' => 1,
                'word_id' => 1,
                'freq_value' => 99.9,
            ],
            [
                'card_id' => 1,
                'word_id' => 1,
                'freq_value' => 99.9,
            ],
            [
                'card_id' => 1,
                'word_id' => 1,
                'freq_value' => 99.9,
            ]
        ];

        foreach($arrData as $data){
            DB::table('frequency_words')->insert($data);
        }

    }
}
