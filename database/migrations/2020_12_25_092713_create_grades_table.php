<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('school_id',false,false)->default(0)->comment('所属驾校');
            $table->string('grade_name',50)->default('')->comment('班级名称');
            $table->string('subject',100)->default('')->comment('科目');
            $table->decimal('price',10,2)->default(0)->comment('价格');
            $table->string('class_hour',10)->default(0)->comment('课时');
            $table->string('types',50)->default('')->comment('练车方式')->nullable(true);
            $table->text('detail')->comment('详情');
            $table->tinyInteger('status')->default(0)->nullable(true)->comment('状态');
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
        Schema::dropIfExists('grades');
    }
}
