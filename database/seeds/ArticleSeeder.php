<?php

use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data_arr = [

        ];

        for($i = 0 ; $i < 100; $i++){
            $data_arr[] = [
                'name' => 'name_'.$i,
                'code' => 'code_gen_'.$i,
                'picture' => 'uploads/ndaA5wdoTy3HEM51KxdHVBSC18QPlMp6IR3BlOoT.jpeg',
                'text' => 'Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать несколько абзацев более менее осмысленного текста рыбы на русском языке, а начинающему оратору отточить навык публичных выступлений в домашних условиях. При создании генератора',
                'title' => 'Заголовок'.$i,
                'description' => 'descr'.$i,
                'active' => true,
                'sort' => 100,
            ];
        }

        foreach($data_arr as $key => $item){
            $id = DB::table('articles')->insertGetId($item);
            $element = \App\Models\Article::find($id);
            if($key < 10)
                $element->retag(["Tag name", "tag name 2", "search", "rung", "get"]);
        }
    }
}
