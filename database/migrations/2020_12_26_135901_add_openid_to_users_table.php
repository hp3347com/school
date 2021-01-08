<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOpenidToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nickname',50)->default('')->nullable(true)->comment('昵称');
            $table->string('openid',50)->default('')->nullable(true)->comment('openid');
            $table->string('phone',20)->default('')->nullable(true)->comment('手机号');
            $table->string('avatar',255)->default('')->nullable(true)->comment('头像');
            $table->tinyInteger('sex',false,false)->default(0)->comment('性别');
            $table->string('address',100)->default('')->comment('地址')->nullable(true);
            $table->tinyInteger('status_type',false,false)->nullable(true)->comment('是否学员');
            $table->integer('sign_up_time',false,false)->default(0)->nullable(true)->comment('报名时间');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
