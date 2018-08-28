<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->charset = 'utf8';
            $table->increments('cate_id')->comment('主键');
            $table->string('cate_name', 25)->default('')->comment('分类名称');
            $table->string('cate_title', 50)->default('')->comment('分类标题');
            $table->integer('cate_sort')->default(0)->comment('分类排序');//排序
            $table->string('keywords', 100)->default('')->comment('分类关键词');//关键词
            $table->string('description', 225)->default('')->comment('分类描述');//描述
            $table->integer('cate_pid')->default(0)->comment('分类主键');//主键
            $table->timestamps();
            $table->primary('cate_id');
            $table->collation = 'utf8_general_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category');
    }
}
