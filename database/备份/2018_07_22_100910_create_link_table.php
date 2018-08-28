<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('link', function (Blueprint $table) {
            $table->engine='MyISAM';
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->increments('link_id')->comment('链接主键');
            $table->string('link_name',30)->default('')->nullable()->comment('链接名称');
            $table->string('link_title',50)->default('')->nullable()->comment('链接标题');
            $table->string('link_url',200)->default('')->nullable()->comment('链接地址');
            $table->integer('link_sort')->default(0)->nullable()->comment('链接排序');
            $table->primary('link_id');
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
        Schema::dropIfExists('link');
    }
}
