<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateCatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat', function (Blueprint $table) {
            $table->increments('cate_id');
            $table->string('cate_name','50');
            $table->string('cate_title');
            $table->string('cate_keywords');
            $table->string('cate_description');
            $table->integer('cate_view');
            $table->tinyInteger('cate_order');
            $table->integer('pid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cat');
    }
}
