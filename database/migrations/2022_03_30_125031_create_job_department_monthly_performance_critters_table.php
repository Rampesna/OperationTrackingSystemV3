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
        Schema::create('job_department_monthly_performance_critters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_department_id');
            $table->unsignedBigInteger('performance_critter_id');
            $table->date('date');
            $table->double('minimum_target');
            $table->double('minimum_target_percent');
            $table->double('default_target');
            $table->double('default_target_percent');
            $table->double('maximum_target');
            $table->double('maximum_target_percent');
            $table->boolean('target_increasing');
            $table->double('percent');
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
        Schema::dropIfExists('job_department_monthly_performance_critters');
    }
};
