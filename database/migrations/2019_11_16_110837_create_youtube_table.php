<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYoutubeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('youtube', function (Blueprint $table) {
            $table->string('code')->unique();
            $table->text('en_text');
            $table->text('ru_text')->nullable();
            $table->text('ipa_text');
            $table->string('picture', 64)->nullable();
            $table->string("title")->nullable();
            $table->string('description', 1024)->nullable();
            $table->bigInteger('section_id')->unsigned();
            $table->foreign('section_id')->references('id')->on('word_sections');
            $table->tinyInteger('status')->index('active_idx');
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
        Schema::dropIfExists('youtube');
    }
}
