<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYuYuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yu_yues', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id',false,true)->default(0)->comment('用户id');
            $table->integer('teacher_id',false,true)->default(0)->comment('教练id');
            $table->integer('school_id',false,true)->default(0)->comment('教练id');
            $table->string('subject',20)->default('')->comment('科目');
            $table->integer('start_time',false,true)->default(0)->comment('开始时间');
            $table->integer('end_time',false,true)->default(0)->comment('结束时间');
            $table->tinyInteger('status',false,false)->default(0)->comment('状态');
            $table->integer('add_time',false,true)->default(0)->comment('预约时间');
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
        Schema::dropIfExists('yu_yues');
    }
}
