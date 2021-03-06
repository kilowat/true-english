<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
           // UsersTableSeeder::class,
            WordSectionsTableSeeder::class,
            WordCardsTableSeeder::class,
            WordsTableSeeder::class,
            WordCardWordsTableSeeder::class,
            GrammarSectionsSeeder::class,
            GrammarSeeder::class,
            AnkiCardSeeder::class,
            ArticleSeeder::class,
        ]);
    }
}
