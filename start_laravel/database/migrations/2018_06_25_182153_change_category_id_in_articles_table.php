<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

// 修改字段需要借助dbal扩展包  composer require doctrine/dbal
class ChangeCategoryIdInArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::table('articles', function (Blueprint $table) {
            $table->string('category_id')->comment('分类id')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->integer('category_id')->unsigned()->default(0)->comment('分类id')->change();
        });
    }
}
