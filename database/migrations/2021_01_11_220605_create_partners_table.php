<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id',false,false)->default(0)->comment('user_id');
            $table->string('real_name',50)->default('')->comment('姓名');
            $table->string('idnumber',20)->default('')->comment('身份证');
            $table->string('phone',20)->default('')->comment('联系电话');
            $table->string('school_name',20)->default('')->comment('驾校名称');
            $table->string('license',255)->default('')->comment('执照');
            $table->tinyInteger('status',false,false)->default(0)->comment('状态');
            $table->integer('create_time',false,false)->default(0)->comment('申请时间');
            $table->integer('reply_time',false,false)->default(0)->nullable(true)->comment('回复时间');
            $table->integer('become_time',false,false)->nullable(true)->default(0)->comment('成为时间');
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
        Schema::dropIfExists('partners');
    }
}
