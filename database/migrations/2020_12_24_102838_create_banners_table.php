<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('title',50)->default('')->comment('标题');
            $table->string('image',255)->default('')->comment('图片地址');
            $table->string('link',255)->default('')->nullable(true)->comment('地址');
            $table->string('sort',false,false)->nullable(true)->default(0)->comment('排序');
            $table->string('position',false,false)->nullable(true)->default(0)->comment('位置，0 首页');
            $table->tinyInteger('status',false,false)->nullable(true)->default(1)->comment('状态，是否显示 1显示');
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
        Schema::dropIfExists('banners');
    }
}
