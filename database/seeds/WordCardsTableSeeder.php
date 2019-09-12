<?php

use Illuminate\Database\Seeder;


class WordCardsTableSeeder extends Seeder
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
              "name" => "Название 1",
              "code" => "code_1",
              "picture" => "",
              "section_id" => 2,
            ],
            [
              "name" => "Название 2",
              "code" => "code_3",
              "picture" => "",
              "section_id" => 2,
            ],
            [
                "name" => "Название 3",
                "code" => "code_4",
                "picture" => "",
                "section_id" => 2,
            ],
            [
                "name" => "Название 4",
                "code" => "code_5",
                "picture" => "",
                "section_id" => 2,
            ],
        ];

        foreach($arrData as $data){
            DB::table('word_cards')->insert($data);
        }
    }
}