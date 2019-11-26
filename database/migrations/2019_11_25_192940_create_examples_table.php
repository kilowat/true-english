<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examples', function (Blueprint $table) {
            $table->string('word')->primary();
            $table->bigInteger("word_id")->unsigned();
            $table->foreign('word_id')
                ->references('id')
                ->on('words')
                ->onUpdate('NO ACTION')
                ->onDelete('cascade');
            $table->text("json_text");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('examples');
    }
}
