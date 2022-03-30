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
        Schema::create('academy_education_plan_participants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('academy_education_plan_id');
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->string('name')->nullable();
            $table->boolean('attendance')->default(0);
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
        Schema::dropIfExists('academy_education_plan_participants');
    }
};
