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
        $dataArr = [
            [
                'name' => 'Сериалы',
                'picture' => '',
                'updated_at' =>  Carbon::now(),
                'created_at' =>  Carbon::now(),
                'children' => [
                    [
                        'name' => 'Теория большого взрыва',
                        'picture' => '',
                        'updated_at' =>  Carbon::now(),
                        'created_at' =>  Carbon::now(),
                    ],
                    [
                        'name' => 'Yes minister',
                        'picture' => '',
                        'updated_at' =>  Carbon::now(),
                        'created_at' =>  Carbon::now(),
                    ],
                    [
                        'name' => 'Друзья',
                        'picture' => '',
                        'updated_at' =>  Carbon::now(),
                        'created_at' =>  Carbon::now(),
                    ],
                ]
            ],
            [
                'name' => 'Youtube',
                'picture' => '',
                'updated_at' =>  Carbon::now(),
                'created_at' =>  Carbon::now(),
                'children' => [
                    [
                        'name' => 'TED',
                        'picture' => '',
                        'updated_at' =>  Carbon::now(),
                        'created_at' =>  Carbon::now(),
                    ],
                    [
                        'name' => 'IT',
                        'picture' => '',
                        'updated_at' =>  Carbon::now(),
                        'created_at' =>  Carbon::now(),
                    ],
                    [
                        'name' => 'Политика',
                        'picture' => '',
                        'updated_at' =>  Carbon::now(),
                        'created_at' =>  Carbon::now(),
                    ],
                ]
            ],
            [
                'name' => 'Мультфильмы',
                'updated_at' =>  Carbon::now(),
                'created_at' =>  Carbon::now(),
                'children' => [
                    [
                        'name' => 'Футурама',
                        'picture' => '',
                        'updated_at' =>  Carbon::now(),
                        'created_at' =>  Carbon::now(),
                    ],
                    [
                        'name' => 'Simpsons',
                        'picture' => '',
                        'updated_at' =>  Carbon::now(),
                        'created_at' =>  Carbon::now(),
                    ],
                    [
                        'name' => 'Lion king',
                        'picture' => '',
                        'updated_at' =>  Carbon::now(),
                        'created_at' =>  Carbon::now(),
                    ],
                ]
            ],
            [
                'name' => 'Книги',
                'updated_at' =>  Carbon::now(),
                'created_at' =>  Carbon::now(),
                'children' => [
                    [
                        'name' => 'Сказки',
                        'picture' => '',
                        'updated_at' =>  Carbon::now(),
                        'created_at' =>  Carbon::now(),
                    ],
                    [
                        'name' => 'Sky fi',
                        'picture' => '',
                        'updated_at' =>  Carbon::now(),
                        'created_at' =>  Carbon::now(),
                    ],
                    [
                        'name' => 'Детективы',
                        'picture' => '',
                        'updated_at' =>  Carbon::now(),
                        'created_at' =>  Carbon::now(),
                    ],
                ],
            ],
            [
                'name' => 'Темы',
                'updated_at' =>  Carbon::now(),
                'created_at' =>  Carbon::now(),
                'children' => [
                    [
                        'name' => 'Профессии',
                        'picture' => '',
                        'updated_at' =>  Carbon::now(),
                        'created_at' =>  Carbon::now(),
                    ],
                    [
                        'name' => 'Природа',
                        'picture' => '',
                        'updated_at' =>  Carbon::now(),
                        'created_at' =>  Carbon::now(),
                    ],
                    [
                        'name' => 'Путешествия',
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
