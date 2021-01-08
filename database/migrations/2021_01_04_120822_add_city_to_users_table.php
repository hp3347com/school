<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCityToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('city',20)->default('')->nullable(true)->comment('city');
            $table->string('language',20)->default('')->nullable(true)->comment('语言');
            $table->string('province',20)->default('')->nullable(true)->comment('省');
            $table->string('country',20)->default('')->nullable(true)->comment('国家');
            $table->string('session_key',255)->default('')->nullable(true)->comment('会话密钥');
            $table->string('unionid',100)->default('')->nullable(true)->comment('开放平台id');
            $table->string('type',20)->default('')->nullable(true)->comment('进入方式');
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

        });
    }
}
