<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('teach_name',50)->default('')->comment('教练姓名');
            $table->string('phone',20)->default('')->comment('手机号码');
            $table->string('gender',10)->default('男')->comment('性别');
            $table->string('avatar',255)->default('')->comment('照片')->nullable(true);
            $table->string('info',255)->default('')->comment('简介')->nullable(true);
            $table->decimal('score',4,2)->default(0)->comment('评分')->nullable(true);
            $table->string('tags',100)->default('')->comment('标签')->nullable(true);
            $table->tinyInteger('sort',false,false)->default(0)->comment('排序')->nullable(true);
            $table->integer('school_id',false,false)->default(0)->comment('驾校')->nullable(true);
            $table->string('password',32)->default('')->comment('登录密码');
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
        Schema::dropIfExists('teachers');
    }
}
