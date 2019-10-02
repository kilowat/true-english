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
                    'active' => true,
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
                'active' => true,
                'children' => $section_testing_data,
            ],
            [
                'name' => 'Youtube',
                'code' => 'youtube',
                'picture' => '',
                'active' => true,
                'updated_at' =>  Carbon::now(),
                'created_at' =>  Carbon::now(),
                'children' => [
                    [
                        'name' => 'TED',
                        'code' => 'ted',
                        'picture' => '',
                        'active' => true,
                        'updated_at' =>  Carbon::now(),
                        'created_at' =>  Carbon::now(),
                    ],
                    [
                        'name' => 'IT',
                        'code' => 'it',
                        'picture' => '',
                        'active' => true,
                        'updated_at' =>  Carbon::now(),
                        'created_at' =>  Carbon::now(),
                    ],
                    [
                        'name' => 'Политика',
                        'code' => 'politic',
                        'active' => true,
                        'picture' => '',
                        'updated_at' =>  Carbon::now(),
                        'created_at' =>  Carbon::now(),
                    ],
                ]
            ],
            [
                'name' => 'Мультфильмы',
                'code' => 'mult',
                'active' => 1,
                'updated_at' =>  Carbon::now(),
                'created_at' =>  Carbon::now(),
                'children' => [
                    [
                        'name' => 'Футурама',
                        'code' => 'futurama',
                        'active' => 1,
                        'picture' => '',
                        'updated_at' =>  Carbon::now(),
                        'created_at' =>  Carbon::now(),
                    ],
                    [
                        'name' => 'Simpsons',
                        'code' => 'simposon',
                        'active' => 1,
                        'picture' => '',
                        'updated_at' =>  Carbon::now(),
                        'created_at' =>  Carbon::now(),
                    ],
                    [
                        'name' => 'Lion king',
                        'code' => 'lion_king',
                        'active' => 1,
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
                'active' => 1,
                'children' => [
                    [
                        'name' => 'Сказки',
                        'code' => 'skazki',
                        'picture' => '',
                        'updated_at' =>  Carbon::now(),
                        'created_at' =>  Carbon::now(),
                        'active' => 1,
                    ],
                    [
                        'name' => 'Sky fi',
                        'code' => 'sky_fi',
                        'picture' => '',
                        'updated_at' =>  Carbon::now(),
                        'created_at' =>  Carbon::now(),
                        'active' => 1,
                    ],
                    [
                        'name' => 'Детективы',
                        'code' => 'books/detective',
                        'picture' => '',
                        'updated_at' =>  Carbon::now(),
                        'created_at' =>  Carbon::now(),
                        'active' => 1,
                    ],
                ],
            ],
            [
                'name' => 'Темы',
                'code' => 'theme',
                'updated_at' =>  Carbon::now(),
                'created_at' =>  Carbon::now(),
                'active' => 1,
                'children' => [
                    [
                        'name' => 'Профессии',
                        'code' => 'prof',
                        'picture' => '',
                        'updated_at' =>  Carbon::now(),
                        'created_at' =>  Carbon::now(),
                        'active' => 1,
                    ],
                    [
                        'name' => 'Природа',
                        'code' => 'waild',
                        'picture' => '',
                        'updated_at' =>  Carbon::now(),
                        'created_at' =>  Carbon::now(),
                        'active' => 1,
                    ],
                    [
                        'name' => 'Путешествия',
                        'code' => 'travel',
                        'picture' => '',
                        'updated_at' =>  Carbon::now(),
                        'created_at' =>  Carbon::now(),
                        'active' => 1,
                    ],
                ],
            ],
        ];

        foreach ($dataArr as $data){
            WordSection::create($data);
        }
    }
}
