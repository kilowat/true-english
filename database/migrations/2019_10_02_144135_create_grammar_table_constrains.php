<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGrammarTableConstrains extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('grammars', function (Blueprint $table) {
            $table->foreign('section_id')
                ->references('id')
                ->on('grammar_sections')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('grammars', function (Blueprint $table) {
            $table->dropForeign('grammars_section_id_foreign');
        });
    }
}
