<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnkiCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anki_cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('picture');
            $table->string('code')->unique();
            $table->mediumText('text')->nullable();
            $table->string('title', 255)->nullable();
            $table->string('file', 50)->nullable();
            $table->string('description', 255)->nullable();
            $table->boolean('active')->default(false);
            $table->integer("sort")->default(100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anki_cards');
    }
}
