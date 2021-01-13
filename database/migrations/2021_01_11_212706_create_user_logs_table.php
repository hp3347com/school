<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id',false,false)->default(0)->comment('用户id');
            $table->string('event',50)->default('')->comment('事件');
            $table->string('params',100)->default('')->nullable(true)->comment('参数');
            $table->integer('admin_id',false,false)->comment('操作人')->nullable(true)->default(0);
            $table->integer('create_time',false,false)->default(0)->comment('创建时间');
            $table->string('mark',100)->default('')->nullable(true)->comment('备注');
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
        Schema::dropIfExists('user_logs');
    }
}
