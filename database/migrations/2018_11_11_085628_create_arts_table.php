<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arts', function (Blueprint $table) {
            $table->increments('art_id');
            $table->string('art_title','100');
            $table->string('art_tag','100');
            $table->string('art_description');
            $table->string('art_thumb');
            $table->text('art_content');
            $table->date('art_time');
            $table->string('art_editor','50');
            $table->integer('art_view');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('arts');
    }
}
