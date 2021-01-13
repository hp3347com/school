<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->integer('sign_id',false,true)->default(0)->comment('报名id');
            $table->integer('user_id',false,true)->default(0)->comment('用户id');
            $table->string('subject',30)->default('')->comment('考试科目');
            $table->integer('exam_time',false,true)->default(0)->comment('考试时间');
            $table->tinyInteger('resut',false,false)->default(0)->comment('考试结果');
            $table->string('mark',50)->default('')->nullable(true)->comment('备注');
            $table->tinyInteger('admin_id',false,true)->comment('管理员id');
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
        Schema::dropIfExists('exams');
    }
}
