<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhrasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phrases', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->string("word", 64)->index('word_idx');
            $table->string("file_name", 255)->index('file_name_idx');
            $table->string("en_text", 255);
            $table->string("ipa_text", 255);
            $table->mediumText("ru_text");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phrases');
    }
}
