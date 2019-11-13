<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSentenceForvoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sentence_forvo', function (Blueprint $table) {
            $table->string("file_name")->index('file_name_idx')->unique();
            $table->string("en_text", 255);
            $table->string("ipa_text", 255);
            $table->string("ru_text", 512);
            $table->boolean("checked")->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sentence_forvo');
    }
}
