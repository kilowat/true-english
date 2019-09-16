<?php

use Illuminate\Database\Seeder;

class WordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 10; $i++){
            DB::table('words')->insert(
                [
                    'name' => 'absolutely'.$i,
                    'transcription' => '|ˈæbsəluːtli|',
                    'translate' => 'абсолютно, совершенно, конечно, полностью, точно, безусловно, просто, совсем, крайне, обязательно, категорически, вообще, несомненно, определенно, никак',
                ]
            );
        }
    }
}
