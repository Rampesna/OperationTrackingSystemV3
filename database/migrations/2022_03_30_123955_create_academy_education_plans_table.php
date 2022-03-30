<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academy_education_plans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('academy_education_lesson_id');
            $table->string('educationist');
            $table->dateTime('start_datetime');
            $table->unsignedBigInteger('academy_education_plan_type_id');
            $table->text('location');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('academy_education_plans');
    }
};
