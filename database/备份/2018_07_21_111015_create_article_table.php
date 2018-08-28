<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->charset = 'utf8';
            $table->increments('art_id')->comment('主键');
            $table->string('art_title', 50)->default('')->comment('文章标题');
            $table->string('art_key', 100)->default('')->comment('文章关键词');//关键词
            $table->string('art_author', 100)->default('')->comment('文章作者');
            $table->string('art_des')->default('')->comment('文章描述');//描述
            $table->string('art_pic')->default('')->comment('文章图片路径');
            $table->text('art_content')->comment('文章内容');
            $table->integer('art_sort')->default(0)->comment('文章排序');//排序
            $table->integer('cate_id')->default(0)->comment('分类id');
            $table->integer('art_count')->default(0)->comment('浏览次数');
            $table->timestamps();
            $table->primary('art_id');
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
        Schema::dropIfExists('article');
    }
}
