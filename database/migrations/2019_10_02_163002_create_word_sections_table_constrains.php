<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWordSectionsTableConstrains extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('word_cards', function (Blueprint $table) {
            $table->foreign('section_id')
                ->references('id')
                ->on('word_sections')
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
        Schema::table('word_cards', function (Blueprint $table) {
            $table->dropForeign('word_cards_section_id_foreign');
        });
    }
}
