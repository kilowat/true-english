<?php

use Illuminate\Database\Seeder;

class GrammarSectionsSeeder extends Seeder
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

        for($i = 0 ; $i < 10; $i++){
            $data_arr[] = [
                'name' => 'name long name long name long name long name'.$i,
                'code' => 'code_'.$i,
                'text' => 'Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать несколько абзацев более менее осмысленного текста рыбы на русском языке, а начинающему оратору отточить навык публичных выступлений в домашних условиях. При создании генератора',
                'title' => 'Заголовок'.$i,
                'description' => 'descr'.$i,
                'active' => true,
                'sort' => 100,
            ];
        }

        foreach($data_arr as $item){
            DB::table('grammar_sections')->insert($item);
        }
    }
}

/*
 *
 *             $table->bigIncrements('id');
            $table->string('name');
            $table->string('code')->unique();
            $table->string('text', 1000)->nullable();
            $table->string('title', 255)->nullable();
            $table->string('description', 255)->nullable();
            $table->boolean('active')->default(false);
            $table->integer("sort")->default(100);
            $table->timestamps();
 */
