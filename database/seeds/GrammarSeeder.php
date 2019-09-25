<?php

use Illuminate\Database\Seeder;

class GrammarSeeder extends Seeder
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
                'name' => 'name_'.$i,
                'code' => 'code_'.$i,
                'section_id' => $i,
                'text' => 'Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать несколько абзацев более менее осмысленного текста рыбы на русском языке, а начинающему оратору отточить навык публичных выступлений в домашних условиях. При создании генератора',
                'title' => 'Заголовок'.$i,
                'description' => 'descr'.$i,
                'active' => true,
                'sort' => 100,
            ];
        }

        foreach($data_arr as $item){
            DB::table('grammars')->insert($item);
        }
    }
}
/*
 *             $table->bigIncrements('id');
            $table->string('name');
            $table->string('code')->unique();
            $table->mediumText('text')->nullable();
            $table->string('title', 255)->nullable();
            $table->string('description', 255)->nullable();
            $table->integer('section_id')->unsigned();
            $table->boolean('active')->default(false);
            $table->integer("sort")->default(100);
            $table->timestamps();
 */