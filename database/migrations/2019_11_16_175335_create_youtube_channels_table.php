<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYoutubeChannelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('youtube_channels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->unique();
            $table->bigInteger('section_id')->unsigned();
            $table->foreign('section_id')->references('id')
                ->on('word_sections')
                ->onUpdate('NO ACTION')
                ->onDelete('cascade');
            $table->tinyInteger('status')->index('status_idx');
            $table->integer('video_count')->default(0);
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
        Schema::dropIfExists('youtube_channels');
    }
}
