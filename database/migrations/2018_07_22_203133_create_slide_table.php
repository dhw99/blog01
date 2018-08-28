<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlideTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slide', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->charset='utf8';
            $table->collation = 'utf8_general_ci';
            $table->increments('slide_id')->comment('轮播图主键');
            $table->string('slide_name',25)->default('')->nullable()->comment('轮播图名称');
            $table->string('slide_url',250)->default('')->nullable()->comment('轮播图地址');
            $table->string('slide_pic',100)->default('')->nullable()->comment('轮播图片路径');
            $table->Integer('slide_sort')->default(0)->nullable()->comment('轮播图排序');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slide');
    }
}
