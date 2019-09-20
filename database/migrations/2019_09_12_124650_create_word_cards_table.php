<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWordCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('word_cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('code')->unique();
            $table->string('uri', 100);
            $table->string('text', 1000)->nullable();
            $table->mediumText('content_text')->nullable();
            $table->string('picture')->nullable();
            $table->string('title', 255)->nullable();
            $table->string('description', 255)->nullable();
            $table->integer('section_id')->unsigned();
            $table->boolean('active')->default(false);
            $table->integer("sort")->default(100);
            $table->timestamps();
        });
        /*
        Schema::table('word_cards', function(Blueprint $table){
            $table->foreign('section_id', 'fk_word_cards_section_id')
                ->references('id')->on('word_sections')
                ->onDelete('cascade');
        });
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('word_cards');
    }
}
