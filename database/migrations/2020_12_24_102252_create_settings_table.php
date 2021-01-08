<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('info',100)->default('')->nullable(true)->comment('配置名称');
            $table->string('menu_name',50)->default('')->comment('字段');
            $table->string('type',50)->nullable(true)->default('')->comment('类型(文本框,单选按钮...）');
            $table->string('input_type',50)->nullable(true)->default('')->comment('表单类型');
            $table->tinyInteger('tab_id',false,false)->nullable(true)->default(0)->comment('分类');
            $table->string('param',255)->nullable(true)->default('')->comment('参数');
            $table->tinyInteger('upload_type',false,false)->nullable(true)->default(0)->comment('上传文件格式，1单图 2，多图 3，文件');
            $table->string('value',255)->default('')->nullable(true)->comment('值');
            $table->string('desc',100)->default('')->nullable(true)->comment('配置简介');
            $table->integer('sort',false,false)->default(0)->nullable(true)->comment('排序');
            $table->tinyInteger('status',false,false)->default(0)->nullable(true)->comment('状态');
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
        Schema::dropIfExists('settings');
    }
}
