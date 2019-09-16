<?php

use Illuminate\Database\Seeder;

class WordCardWordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 50; $i++){
            DB::table('word_card_words')->insert([
                'word' => 'absolutely'.$i,
                'card_id' => 1,
            ]);
        }
    }
}