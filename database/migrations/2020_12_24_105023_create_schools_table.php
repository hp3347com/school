<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('school_name',50)->default('')->comment('驾校名称');
            $table->string('sub_name',50)->default('')->comment('副标题');
            $table->string('school_logo',255)->default('')->comment('驾校logo');
            $table->string('tags',100)->default('')->nullable(true)->comment('标签');
            $table->string('tel',20)->default('')->nullable(true)->comment('电话');
            $table->decimal('score',4,2)->default(0)->nullable(true)->comment('评分');
            $table->string('images',255)->default('')->nullable(true)->comment('轮播图');
            $table->tinyInteger('status',false,false)->default(1)->nullable(true)->comment('状态');
            $table->tinyInteger('is_recomment',false,false)->default(0)->nullable(true)->comment('是否推荐');
            $table->integer('sort',false,false)->default(0)->nullable(true)->comment('排序');
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
        Schema::dropIfExists('schools');
    }
}
