<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\GrammarSection::class, function (Faker $faker) {
    return [
        'name' => [$faker->words(8)],
        'code' => [$faker->unixTime('now')."_".$faker->word],
        'text' => [$faker->text(100)],
        'title' => [$faker->words(8)],
        'description' => [$faker->text(20)],
        'active' => [$faker->boolean(2)],
    ];
});

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