<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSignUpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sign_ups', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id',false,false)->default(0)->comment('用户id');
            $table->string('user_name',50)->default('')->comment('姓名');
            $table->string('gener',10)->default('')->comment('性别');
            $table->string('idnumber',20)->default('')->comment('身份证号码');
            $table->tinyInteger('school_id',false,false)->default(0)->comment('驾校id');
            $table->string('sign_type',20)->default('')->comment('驾照类型');
            $table->tinyInteger('status',false,false)->default(0)->comment('状态');
            $table->integer('sign_time',false,false)->default(0)->comment('报名时间');
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
        Schema::dropIfExists('sign_ups');
    }
}
