<?php

use Illuminate\Database\Seeder;

class WordCardsWordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 50; $i++){
            DB::table('word_cards_words')->insert([
                'word_id' => $i,
                'card_id' => 1,
            ]);
        }
    }
}

/*
 *          $table->integer("word_id")->unsigned();
            $table->integer("card_id")->unsigned();
 */