<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config', function (Blueprint $table) {
            $table->increments('conf_id');
            $table->string('conf_title',50);
            $table->string('conf_name',50);
            $table->text('conf_content');
            $table->tinyinteger('conf_order')->default('0')->comment('//排序');
            $table->string('conf_tips');
            $table->string('field_type',50);
            $table->string('field_value')->default('')->comment('//类型值');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('config');
    }
}
