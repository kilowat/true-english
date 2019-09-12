<?php

use App\Models\WordSection;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class WordSectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $section_testing_data = [];

        for($i = 0; $i < 100; $i++){
            $section_testing_data[] = [
                    'name' => 'Название'.$i,
                    'code' => 'code'.$i,
                    'picture' => '',
                    'updated_at' =>  Carbon::now(),
                    'created_at' =>  Carbon::now(),
            ];
        }

        $dataArr = [
            [
                'name' => 'Сериалы',
                'code' => 'serials',
                'picture' => '',
                'updated_at' =>  Carbon::now(),
                'created_at' =>  Carbon::now(),
                'children' => $section_testing_data,
            ],
            [
                'name' => 'Youtube',
                'code' => 'youtube',
                'picture' => '',
                'updated_at' =>  Carbon::now(),
                'created_at' =>  Carbon::now(),
                'children' => [
                    [
                        'name' => 'TED',
                        'code' => 'ted',
                        'picture' => '',
                        'updated_at' =>  Carbon::now(),
                        'created_at' =>  Carbon::now(),
                    ],
                    [
                        'name' => 'IT',
                        'code' => 'it',
                        'picture' => '',
                        'updated_at' =>  Carbon::now(),
                        'created_at' =>  Carbon::now(),
                    ],
                    [
                        'name' => 'Политика',
                        'code' => 'politic',
                        'picture' => '',
                        'updated_at' =>  Carbon::now(),
                        'created_at' =>  Carbon::now(),
                    ],
                ]
            ],
            [
                'name' => 'Мультфильмы',
                'code' => 'mult',
                'updated_at' =>  Carbon::now(),
                'created_at' =>  Carbon::now(),
                'children' => [
                    [
                        'name' => 'Футурама',
                        'code' => 'futurama',
                        'picture' => '',
                        'updated_at' =>  Carbon::now(),
                        'created_at' =>  Carbon::now(),
                    ],
                    [
                        'name' => 'Simpsons',
                        'code' => 'simposon',
                        'picture' => '',
                        'updated_at' =>  Carbon::now(),
                        'created_at' =>  Carbon::now(),
                    ],
                    [
                        'name' => 'Lion king',
                        'code' => 'lion_king',
                        'picture' => '',
                        'updated_at' =>  Carbon::now(),
                        'created_at' =>  Carbon::now(),
                    ],
                ]
            ],
            [
                'name' => 'Книги',
                'code' => 'books',
                'updated_at' =>  Carbon::now(),
                'created_at' =>  Carbon::now(),
                'children' => [
                    [
                        'name' => 'Сказки',
                        'code' => 'skazki',
                        'picture' => '',
                        'updated_at' =>  Carbon::now(),
                        'created_at' =>  Carbon::now(),
                    ],
                    [
                        'name' => 'Sky fi',
                        'code' => 'sky_fi',
                        'picture' => '',
                        'updated_at' =>  Carbon::now(),
                        'created_at' =>  Carbon::now(),
                    ],
                    [
                        'name' => 'Детективы',
                        'code' => 'books/detective',
                        'picture' => '',
                        'updated_at' =>  Carbon::now(),
                        'created_at' =>  Carbon::now(),
                    ],
                ],
            ],
            [
                'name' => 'Темы',
                'code' => 'theme',
                'updated_at' =>  Carbon::now(),
                'created_at' =>  Carbon::now(),
                'children' => [
                    [
                        'name' => 'Профессии',
                        'code' => 'prof',
                        'picture' => '',
                        'updated_at' =>  Carbon::now(),
                        'created_at' =>  Carbon::now(),
                    ],
                    [
                        'name' => 'Природа',
                        'code' => 'waild',
                        'picture' => '',
                        'updated_at' =>  Carbon::now(),
                        'created_at' =>  Carbon::now(),
                    ],
                    [
                        'name' => 'Путешествия',
                        'code' => 'travel',
                        'picture' => '',
                        'updated_at' =>  Carbon::now(),
                        'created_at' =>  Carbon::now(),
                    ],
                ],
            ],
        ];

        foreach ($dataArr as $data){
            WordSection::create($data);
        }
    }
}
