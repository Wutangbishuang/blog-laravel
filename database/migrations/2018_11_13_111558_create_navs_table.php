<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navs', function (Blueprint $table) {
            $table->increments('nav_id');
            $table->string('nav_name',50)->default('')->comment('导航名字');
            $table->string('nav_alias',50)->default('')->comment('导航解释');
            $table->string('nav_url')->default('')->comment('地址');
            $table->integer('nav_order')->default('0')->comment('排序');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('navs');
    }
}
