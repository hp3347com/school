<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('title',50)->default('')->comment('标题');
            $table->string('image',255)->default('')->comment('图片');
            $table->string('link',255)->default('')->comment('跳转地址');
            $table->integer('sort',false,false)->default(0)->comment('排序');
            $table->tinyInteger('status',false,false)->default(1)->comment('是否显示 1显示');
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
        Schema::dropIfExists('navs');
    }
}
