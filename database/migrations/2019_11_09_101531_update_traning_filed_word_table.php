<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTraningFiledWordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('words', function (Blueprint $table) {
            $table->integer('phrase_training')->default(0);
            $table->integer('translate_training')->default(0);
            $table->integer('listen_training')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('words', function($table) {
            $table->dropColumn('phrase_training');
            $table->dropColumn('translate_training');
            $table->dropColumn('listen_training');
        });
    }
}
