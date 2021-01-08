<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('school_id',false,false)->default(0)->comment('驾校')->nullable(true);
            $table->integer('teacher_id',false,false)->default(0)->comment('教练')->nullable(true);
            $table->integer('grade_id',false,false)->default(0)->comment('班次')->nullable(true);
            $table->string('comment',255)->default('')->comment('评论');
            $table->string('images',255)->default('')->comment('图片')->nullable(true);
            $table->tinyInteger('score',false,false)->default(0)->comment('评分');
            $table->integer('user_id',false,false)->default(0)->comment('用户');
            $table->string('reply',255)->default('')->nullable(true)->comment('回复');
            $table->integer('comment_time',false,false)->comment('评论时间')->default(0);
            $table->integer('reply_time',false,false)->comment('回复时间')->nullable(true)->default(0);
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
        Schema::dropIfExists('comments');
    }
}
